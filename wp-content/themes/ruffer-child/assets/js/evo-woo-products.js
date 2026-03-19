jQuery(document).ready(function ($) {
	$('.evo-ajax-filter').on('change', function () {
		var wrapper = $(this).closest('.evo-products-wrapper');
		var container = wrapper.find('.evo-results-grid');

		var data = {
			action: 'evo_filter_products',
			restricted: wrapper.data('restricted'),
			tag: wrapper.find('[data-tax="product_tag"]').val(),
			cat: wrapper.find('[data-tax="product_cat"]').val(), // Will be undefined if hidden
		};

		container.css('opacity', '0.5'); // Visual feedback

		$.post(evo_ajax_obj.ajax_url, data, function (response) {
			container.html(response).css('opacity', '1');
		});
	});
});
