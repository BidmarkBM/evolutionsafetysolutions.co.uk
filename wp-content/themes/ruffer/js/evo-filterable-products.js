/**
 * Evo Filterable Products – front-end AJAX filtering
 */
(function ($) {
	'use strict';

	// Debounce helper
	function debounce(fn, delay) {
		var timer;
		return function () {
			var context = this,
				args = arguments;
			clearTimeout(timer);
			timer = setTimeout(function () {
				fn.apply(context, args);
			}, delay);
		};
	}

	$(document).ready(function () {
		$('.evo-filterable-products').each(function () {
			var $wrapper = $(this);
			var uid = $wrapper.attr('id');
			var categories = $wrapper.data('categories') || [];
			var perPage = $wrapper.data('per-page') || 12;
			var columns = $wrapper.data('columns') || 4;
			var orderby = $wrapper.data('orderby') || 'menu_order title';
			var order = $wrapper.data('order') || 'ASC';

			// Current filter state
			var state = {
				sort: '',
				sub_cat: '',
				tag: '',
				attributes: {},
				min_price: '',
				max_price: '',
				search: '',
				paged: 1,
			};

			// ---- Capture original filter options from PHP-rendered selects ----
			// We store these once so updateFilters() can rebuild them from a clean slate.
			var origOptions = {};
			(function () {
				function capture($sel, key) {
					var opts = [];
					$sel.find('option').each(function () {
						opts.push({
							value: $(this).val(),
							text: $(this).text(),
						});
					});
					origOptions[key] = opts;
				}
				capture($wrapper.find('.evo-filter-subcat'), 'sub_cat');
				capture($wrapper.find('.evo-filter-tag'), 'tag');
				$wrapper.find('.evo-filter-attribute').each(function () {
					capture($(this), $(this).data('taxonomy'));
				});
			})();

			// ---- Rebuild filter dropdowns based on server-returned facets ----
			// For each dimension, only options whose slug appears in facets[key]
			// are included. The blank "All X" option is always kept.
			function updateFilters(facets) {
				if (!facets) {
					return;
				}

				function rebuildSelect($sel, facetKey) {
					if (!$sel.length || !origOptions[facetKey]) {
						return;
					}
					var currentVal = $sel.val();
					var allowed = facets[facetKey] || [];
					$sel.empty();
					$.each(origOptions[facetKey], function (i, opt) {
						// Always keep the blank "All X" option
						if (!opt.value || allowed.indexOf(opt.value) !== -1) {
							$sel.append(
								$('<option>', {
									value: opt.value,
									text: opt.text,
								}),
							);
						}
					});
					// Restore selection if still available, otherwise reset to blank
					var stillAvailable = false;
					$sel.find('option').each(function () {
						if ($(this).val() === currentVal) {
							stillAvailable = true;
						}
					});
					$sel.val(stillAvailable ? currentVal : '');
				}

				rebuildSelect($wrapper.find('.evo-filter-subcat'), 'sub_cat');
				rebuildSelect($wrapper.find('.evo-filter-tag'), 'tag');
				$wrapper.find('.evo-filter-attribute').each(function () {
					rebuildSelect($(this), $(this).data('taxonomy'));
				});
			}

			// Fetch products via AJAX
			function fetchProducts() {
				var $grid = $('#' + uid + '-grid');
				var $loading = $wrapper.find('.evo-loading');

				$loading.show();
				$grid.css('opacity', '0.4');

				$.post(evoProducts.ajaxurl, {
					action: 'evo_filter_products',
					nonce: evoProducts.nonce,
					categories: JSON.stringify(categories),
					per_page: perPage,
					columns: columns,
					orderby: orderby,
					order: order,
					paged: state.paged,
					sort: state.sort,
					sub_cat: state.sub_cat,
					tag: state.tag,
					attributes: JSON.stringify(state.attributes),
					min_price: state.min_price,
					max_price: state.max_price,
					search: state.search,
				})
					.done(function (response) {
						if (response.success) {
							$grid.html(response.data.html);
							renderActivePills();
							bindPagination();
							updateFilters(response.data.facets);
						}
					})
					.always(function () {
						$loading.hide();
						$grid.css('opacity', '1');
						// Scroll to top of widget
						$('html, body').animate(
							{ scrollTop: $wrapper.offset().top - 80 },
							300,
						);
					});
			}

			// Render active filter pills
			function renderActivePills() {
				var $pills = $('#' + uid + '-active');
				$pills.empty();

				var hasAny = false;

				if (state.sort) {
					hasAny = true;
					$pills.append(
						'<span class="evo-pill" data-clear="sort">Sort: ' +
							$wrapper
								.find('.evo-filter-sort option:selected')
								.text() +
							' <button type="button">&times;</button></span>',
					);
				}
				if (state.sub_cat) {
					hasAny = true;
					$pills.append(
						'<span class="evo-pill" data-clear="sub_cat">Category: ' +
							state.sub_cat +
							' <button type="button">&times;</button></span>',
					);
				}
				if (state.tag) {
					hasAny = true;
					$pills.append(
						'<span class="evo-pill" data-clear="tag">Tag: ' +
							state.tag +
							' <button type="button">&times;</button></span>',
					);
				}
				$.each(state.attributes, function (tax, slug) {
					if (slug) {
						hasAny = true;
						$pills.append(
							'<span class="evo-pill" data-clear-attr="' +
								tax +
								'">' +
								slug +
								' <button type="button">&times;</button></span>',
						);
					}
				});
				if (state.min_price || state.max_price) {
					hasAny = true;
					var priceLabel =
						'Price: ' +
						(state.min_price || '0') +
						' – ' +
						(state.max_price || '∞');
					$pills.append(
						'<span class="evo-pill" data-clear="price">' +
							priceLabel +
							' <button type="button">&times;</button></span>',
					);
				}
				if (state.search) {
					hasAny = true;
					$pills.append(
						'<span class="evo-pill" data-clear="search">Search: ' +
							state.search +
							' <button type="button">&times;</button></span>',
					);
				}

				if (hasAny) {
					$pills.append(
						'<button type="button" class="evo-clear-all button">Clear all</button>',
					);
				}

				// Pill click handlers
				$pills.find('.evo-pill button').on('click', function () {
					var $pill = $(this).closest('.evo-pill');
					var clearKey = $pill.data('clear');
					var clearAttr = $pill.data('clear-attr');

					if (clearKey === 'price') {
						state.min_price = '';
						state.max_price = '';
						$wrapper.find('.evo-filter-min-price').val('');
						$wrapper.find('.evo-filter-max-price').val('');
					} else if (clearKey === 'search') {
						state.search = '';
						$wrapper.find('.evo-filter-search').val('');
					} else if (clearAttr) {
						delete state.attributes[clearAttr];
						$wrapper
							.find(
								'.evo-filter-attribute[data-taxonomy="' +
									clearAttr +
									'"]',
							)
							.val('');
					} else if (clearKey) {
						state[clearKey] = '';
						$wrapper.find('.evo-filter-' + clearKey).val('');
						// Also reset the select that matches
						if (clearKey === 'sort')
							$wrapper.find('.evo-filter-sort').val('');
						if (clearKey === 'sub_cat')
							$wrapper.find('.evo-filter-subcat').val('');
						if (clearKey === 'tag')
							$wrapper.find('.evo-filter-tag').val('');
					}

					state.paged = 1;
					fetchProducts();
				});

				// Clear all
				$pills.find('.evo-clear-all').on('click', function () {
					state = {
						sort: '',
						sub_cat: '',
						tag: '',
						attributes: {},
						min_price: '',
						max_price: '',
						search: '',
						paged: 1,
					};
					$wrapper.find('select').val('');
					$wrapper.find('input').val('');
					fetchProducts();
				});
			}

			// Bind AJAX pagination (hijack pagination links)
			function bindPagination() {
				$wrapper
					.find('.woocommerce-pagination a.page-numbers')
					.off('click')
					.on('click', function (e) {
						e.preventDefault();
						var href = $(this).attr('href');
						var match = href.match(/paged[=\/](\d+)/);
						if (match) {
							state.paged = parseInt(match[1], 10);
						} else {
							// Might be page/2/ format
							var match2 = href.match(/\/page\/(\d+)/);
							if (match2) {
								state.paged = parseInt(match2[1], 10);
							}
						}
						fetchProducts();
					});
			}

			// ----- Bind filter controls -----

			// Sort
			$wrapper.find('.evo-filter-sort').on('change', function () {
				state.sort = $(this).val();
				state.paged = 1;
				fetchProducts();
			});

			// Sub-category
			$wrapper.find('.evo-filter-subcat').on('change', function () {
				state.sub_cat = $(this).val();
				state.paged = 1;
				fetchProducts();
			});

			// Tag
			$wrapper.find('.evo-filter-tag').on('change', function () {
				state.tag = $(this).val();
				state.paged = 1;
				fetchProducts();
			});

			// Attributes
			$wrapper.find('.evo-filter-attribute').on('change', function () {
				var tax = $(this).data('taxonomy');
				state.attributes[tax] = $(this).val();
				state.paged = 1;
				fetchProducts();
			});

			// Price filter button
			$wrapper.find('.evo-price-go').on('click', function () {
				var $priceWrap = $(this).closest('.evo-price-filter');
				state.min_price = $priceWrap
					.find('.evo-filter-min-price')
					.val();
				state.max_price = $priceWrap
					.find('.evo-filter-max-price')
					.val();
				state.paged = 1;
				fetchProducts();
			});

			// Search (debounced – fires 500ms after the user stops typing)
			$wrapper.find('.evo-filter-search').on(
				'input',
				debounce(function () {
					state.search = $(this).val();
					state.paged = 1;
					fetchProducts();
				}, 500),
			);

			// Initial pagination binding
			bindPagination();
			renderActivePills();

			// Apply server-side initial facets so only relevant options show on load
			var initialFacets = $wrapper.data('initial-facets');
			if (initialFacets) {
				updateFilters(initialFacets);
			}
		});
	});
})(jQuery);
