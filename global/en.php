<?php
    function lang($phrase) {
        static $lang = array(
            // Page Header
            'Home' => 'Home' ,
            'About' => 'About' ,
            'Work' => 'Work' ,
            'Blog' => 'Blog' ,
            'Contact' => 'Contact',
            'LogIn' => 'LogIn',
            'Menu' => 'Menu',
            'Admin' => 'Admin',
            'Control Panel' => 'Control Panel',
            'Employees' => 'Employees',
            'Add' => 'Add',
            'Display' => 'Display',
            'Floors' => 'Floors',
            'Features' => 'Features',
            'Services' => 'Services',
            'Clients' => 'Clients',
            'LogOut' => 'LogOut',
            'A' => 'A',

            // Page admin index
            'Settings' => 'Settings',

            // Page LogIn
            'UserName' => 'UserName',
            'Password' => 'Password',
            'Sorry You Don\'t Have An Account' => 'Sorry You Don\'t Have An Account',

            // Page Footer
            'Daarna Hotel' => 'Daarna Hotel',
            'information about the company' => 'information about the company',
            'help' => 'help',
            'information Office' => 'information Office',
            'investor relations' => 'investor relations',
            'Learn how a website works' => 'Learn how a website works',
            'Terms and Conditions' => 'Terms and Conditions',
            'Legal information' => 'Legal information',
            'Privacy Notice' => 'Privacy Notice',
            'Site Map' => 'Site Map',
            'Copyrights' => 'Copyrights',
            'all rights are save' => 'all rights are save',
        );
        return $lang[$phrase];
    }
    ?>