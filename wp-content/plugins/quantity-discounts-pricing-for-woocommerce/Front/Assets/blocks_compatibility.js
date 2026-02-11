const { registerCheckoutFilters } = window.wc.blocksCheckout;

const modifyShowApplyCouponNotice = ( defaultValue, extensions, args ) => {

	if (general_settings['plgfqdp_coupon_settings'] == 'plgfqdp_aply_nly_cpn') {
		window.location.reload();
		return false;
	}

	return defaultValue;
};

const modifyShowRemoveCouponNotice = ( defaultValue, extensions, args ) => {
	if (general_settings['plgfqdp_coupon_settings'] == 'plgfqdp_aply_nly_cpn') {
		window.location.reload();
		return false;
	}
	return defaultValue;
};

registerCheckoutFilters( 'plugify_qdp_discount_data', {
	showApplyCouponNotice: modifyShowApplyCouponNotice,
	showRemoveCouponNotice: modifyShowRemoveCouponNotice,
});