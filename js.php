<!-- Load JS -->
<script type="text/javascript">
    jQuery(document).ready(function () {
        // prettyPhoto
        jQuery("a[rel^='prettyPhoto']").prettyPhoto({
            social_tools: false
        });

        // tooltip
        jQuery('.tool-tip').tooltip();

        <?php if (get_option('mpt_enable_sticky_header') == 'true') { ?>
            //Waypoints
            jQuery.waypoints.settings.scrollThrottle = 30;
            jQuery('#body-wrapper').waypoint(function(event, direction) {
                offset: '-100%'
            }).find('#header-wrapper').waypoint(function(event, direction) {
                jQuery(this).toggleClass('navbar-fixed-top', direction === "down");
                event.stopPropagation();
            });
        <?php } ?>
    });
</script>