<div class="sg-dialog-wrapper sg-dialog-wrapper--animation-open sg-dialog-confirmation">
    <div class="sg-dialog sg-dialog--align-center sg-dialog--size-medium sg-dialog--density-medium sg-dialog--state-warning" tabindex="0">
        <div class="sg-dialog__content-wrapper">
            <div class="sg-dialog__icon-wrapper">
                <div class="sg-dialog__icon">
                    <span class="sg-icon sg-icon--fill-lighter" data-e2e="icon" data-component="icon" data-icon="warning" role="img" style="width: 30px; height: 30px;">
                        <img src="<?php echo \SiteGround_Central\URL . '/assets/img/warning.svg'; ?>" width="30" height="30">
                    </span>
                </div>
            </div>
            <div class="sg-dialog__title-wrapper">
                <h3 class="sg-title sg-title--density-compact sg-title--level-3 sg-with-color sg-with-color--color-darkest sg-typography sg-typography--align-center sg-typography--weight-medium sg-dialog__title">
                    <?php _e( 'Action Required', 'siteground-wizard' ); ?>
                </h3>
            </div>
	        <div class="sg-dialog__content">
	            <p class="sg-text sg-text--size-medium sg-with-color sg-with-color--color-darkest sg-typography sg-typography--align-left sg-typography--weight-regular">
                    <?php _e( "Do you want to import the sample data when installing the theme?
                    <br/><br/>
                    <strong>Note, that this will delete your existing content!</strong>", 'siteground-wizard' ); ?>
                </p>
            </div>
        </div>
        <div class="sg-toolbar sg-toolbar--background-light sg-toolbar--density-comfortable sg-toolbar--align-baseline sg-toolbar--justify-flex-end sg-toolbar--direction-row">
            <div>
                <button type="submit" class="sg-ripple-container sg-button sg-button--neutral sg-button--medium sg-modal-close">
					<span class="sg-button__content"><?php _e( 'Cancel', 'siteground-wizard' ); ?> </span>
                </button>
                <button type="submit" class="sg-ripple-container sg-button sg-button--neutral sg-button--medium sg-button-modal-install sg-modal-no" data-sample="0">
					<span class="sg-button__content"><?php _e( 'No', 'siteground-wizard' ); ?> </span>
                </button>
                <button type="submit" class="sg-ripple-container sg-button sg-button--primary sg-button--medium sg-button-modal-install sg-modal-yes" data-sample="1">
					<span class="sg-button__content"><?php _e( 'Yes', 'siteground-wizard' ); ?> </span>
                </button>
            </div>
        </div>
    </div>
</div>

<div class="sg-dialog-wrapper sg-dialog-wrapper--animation-open sg-dialog-progress">
    <div class="sg-dialog sg-dialog--align-center sg-dialog--size-medium sg-dialog--density-medium sg-dialog--no-state" tabindex="0">
        <div class="sg-dialog__content-wrapper">
            <div class="sg-dialog__content">
                <div class="sg-flex sg-flex--align-center sg-flex--justify-center">
                    <img src="<?php echo \SiteGround_Central\URL . '/assets/img/lds-gears.svg'; ?>" width="130" height="130">
                    <h3 class="sg-title sg-title--density-comfortable sg-title--level-3 sg-with-color sg-with-color--color-darkest sg-typography sg-typography--weight-regular">
                        <?php _e( "Installing, please don't close or refresh this page.", 'siteground-wizard' ); ?>
                    </h3>
                    <div style="margin-bottom: 24px; width: 100%;">
                        <div class="sg-progress" tabindex="0" data-e2e="progress" data-component="progress" role="progressbar" aria-valuenow="18" aria-valuemin="0" aria-valuemax="100">
                            <div class="sg-progress__indicator sg-progress__indicator--color-blue" style="transform: translateX(-82%);"></div>
                        </div>
                    </div>
                    <p class="status-message"><?php _e( 'Installing Theme', 'siteground-wizard' ); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="sg-dialog-wrapper sg-dialog-wrapper--animation-open sg-dialog-success">
    <div class="sg-dialog sg-dialog--align-center sg-dialog--size-medium sg-dialog--density-medium sg-dialog--state-active" tabindex="0">
        <div class="sg-dialog__content-wrapper">
            <div class="sg-dialog__icon-wrapper">
                <div class="sg-dialog__icon">
                    <span class="sg-icon sg-icon--fill-lighter" data-e2e="icon" data-component="icon" data-icon="warning" role="img" style="width: 30px; height: 30px;">
                        <img src="<?php echo \SiteGround_Central\URL . '/assets/img/check.svg'; ?>" width="30" height="30">
                    </span>
                </div>
            </div>
            <div class="sg-dialog__title-wrapper">
                <h3 class="sg-title sg-title--density-compact sg-title--level-3 sg-with-color sg-with-color--color-darkest sg-typography sg-typography--align-center sg-typography--weight-medium sg-dialog__title">
                    <?php _e( 'Congrats! Your site is ready!', 'siteground-wizard' ); ?>
                </h3>
            </div>
            <div class="sg-dialog__content">
                <p class="sg-text sg-text--size-medium sg-with-color sg-with-color--color-darkest sg-typography sg-typography--align-left sg-typography--weight-regular">
                    <?php _e( 'We have successfully completed the installation of the items you selected. You may now proceed to your WordPress dashboard and start managing your site.', 'siteground-wizard' ); ?>
                </p>
            </div>
        </div>
        <div class="sg-toolbar sg-toolbar--background-light sg-toolbar--density-comfortable sg-toolbar--align-baseline sg-toolbar--justify-flex-end sg-toolbar--direction-row">
            <div>
                <button type="submit" class="sg-ripple-container sg-button sg-button--neutral sg-button--medium sg-modal-close">
                    <span class="sg-button__content"><?php _e( 'Close', 'siteground-wizard' ); ?></span>
                </button>
                <a href="<?php echo site_url( '/' ) ?>" class="sg-ripple-container sg-button sg-button--primary sg-button--medium sg-modal-view-site">
                    <span class="sg-button__content"><?php _e( 'View site', 'siteground-wizard' ); ?></span>
                </a>
            </div>
        </div>
    </div>
</div>