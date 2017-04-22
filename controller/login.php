<?php
// Get the FacebookRedirectLoginHelper
    $helper = $fb->getRedirectLoginHelper();

    $permissions = ['email', 'public_profile']; // optional
    $loginUrl = $helper->getLoginUrl('https://razmkhah.ir/success', $permissions);

    echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';