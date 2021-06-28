<?php

set_time_limit(10000);
require 'vendor/autoload.php';
require_once('PHPUnit/Extensions/AppiumTestCase.php');
require_once('PHPUnit/Extensions/AppiumTestCase/Element.php');
class AutoCloner
{
    private $url;
    private $driver;
    private $session;
    private $element;
    
    //Start Bluestacks
    public function startBluestacks()
    {
        //Create URL
        $this->url = new PHPUnit_Extensions_Selenium2TestCase_URL("http://localhost:4723/");
        
        //Create driver
        $this->driver = new PHPUnit_Extensions_AppiumTestCase_Driver($this->url);

        //Create Session
        $this->session = $this->driver->startSession(array(
                            "platformName" => "Android",
                            "deviceName" => "C:\Program Files\BlueStacks_nxt\HD-Player.exe",
        ), $this->url);

        //Create Element
        $this->element = new PHPUnit_Extensions_AppiumTestCase_Element($this->session->getDriver(), $this->session->getSessionUrl());
    }

    //Start AppCloner
    public function startAppCloner()
    {
        //Open AppCloner
        $this->session->getDriver()->curl(
            'POST',
            $this->session->getSessionUrl()->descend('appium')->descend('device')->descend('start_activity'),
            array(
            'appPackage' => 'com.applisto.appcloner',
            'appActivity' => 'com.applisto.appcloner.activity.MainActivity'
            )
        );
        //Click APK Files
        $this->byAccID("    APK files")->click();
    }

    //Start Clone
    public function startClone()
    {
        // //Add APK Files
        // $this->elementClickByAccID("Add APK file");
        // //Choose Source
        // $this->byText("android.widget.RadioButton", "From a directory")->click();
        // //Click DICM
        // $this->byText("android.widget.TextView", "DCIM")->click();
        // //Click ShareFolder
        // $this->byText("android.widget.TextView", "SharedFolder")->click();
        // //Click Done
        // $this->elementByXpath("/hierarchy/android.widget.FrameLayout/android.widget.LinearLayout/android.widget.FrameLayout/android.widget.LinearLayout/android.widget.FrameLayout/android.widget.LinearLayout/android.widget.FrameLayout/android.widget.FrameLayout/android.widget.ImageButton")->click();

        //Select database
        $newname = "LMSQ v2";
        $name = "Liên Minh Siêu Quậy";
        $version = "1.0.7";
        $value = "$name\n$version";
        $infoClone = array(
            //Select the clone number range
            "numberClone" => 2,
            //Append clone number to name
            "appendToName" => true,
            //Change icon color
            "iconColor" => true,
            //Set clone number as badge
            "numberBadge" => true
        );
    
        $Default = array(
            "Cloning options﻿    " => array(
                "Cloning mode" => array(
                    "Default" => true,
                    "Manifest" => false
                ),
                "Skip native libraries" => false,
                "Increase compatibility" => array(
                    "Enabled" => false,
                    "Native method workaround" => false
                ),
                "Ignore crashes" => array(
                    "Ignore crashes" => false,
                    "Show crash messages" => false
                ),
                "Hide the 'Cloned by App Cloner' pop-up" => true,
                "Google Play Services workaround" => false,
                "Hide Google Play Services" => false,
                "Disable Firebase Crashlytics" => false,
                //Hide emulator
                //Disable signature verification
                //Disable license validation﻿
                "Facebook login" => array(
                    "Default" => false,
                    "Web form (recommended)" => true,
                    "Web form (alternative)" => false,
                ),
                "Twitter login"=> array(
                    "Default" => false,
                    "Web form (recommended)" => true,
                ),
                "Disable Chrome Custom Tabs" => false,
                "Local activities" => false,
                "Local broadcasts & services" => false,
                //Single process
                "Package name check workaround" => false,
                "APK check workaround﻿    " => false,
                "Early hooks﻿    " => false,
                "No kill" => array(
                    "Enabled" => false,
                    "Prevent finishing activities" => false
                ),
                "Safe mode" => false,
                //Allow in multi-account apps
                "Hide from Cloned apps" => false,
                "Ignore updates" => false,
            ),
            "Identity & tracking options" => array(
                "Change Android ID" => array(
                    "No change" => true,
                    "Random" => false,
                    "Custom" => false,
                    "Android ID" => "",
                    "Use same settings for Android serial" => true,
                ),
                "Change IMEI / IMSI" =>array(
                    "No change" => true,
                    "Random" => false,
                    "Custom" => false,
                    "IMEI" => "",
                    "Use same settings for IMSI" => true,
                ),
                "Change Wi-Fi MAC address" => array(
                    "No change" => true,
                    "Hide" => false,
                    "Random" => false,
                    "Custom" => false,
                    "MAC address" => "",
                    "Hide Wi-Fi info" => false,
                ),
                "Change Bluetooth MAC address"=>array(
                    "No change" => true,
                    "Hide" => false,
                    "Random" => false,
                    "Custom" => false,
                    "MAC address" => "",
                ),
                "Hide SIM & operator info" => false,
                "Hide GPU info" => false,
                "Change Google Advertising ID"=>array(
                    "No change" => true,
                    "Hide" => false,
                    "Random" => false,
                    "Custom" => false,
                    "Hex value" => "",
                ),
                "Change Google Service Framework (GSF) ID"=>array(
                    "No change" => true,
                    "Hide" => false,
                    "Random" => false,
                    "Custom" => false,
                    "Hex value" => "",
                ),
                "Change WebView User-Agent"=>array(
                    "No change" => true,
                    "Random" => false,
                    "Custom" => false,
                    "Mozilla/5.0 (Linux; Android) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.####.****** Mobile Safari/537.36" => "",
                ),
                "Build props" => array(
                    "MANUFACTURER" => "",
                    "BRAND" => "",
                    "MODEL" => "",
                    "PRODUCT" => "",
                    "DEVICE" => "",
                    "BOARD"=> "",
                    "RADIO" =>"",
                    "HARDWARE" => "",
                    "BOOTLOADER" => "",
                    "FINGERPRINT" => "",
                    "BUILD" => "",
                    "OS VERSION" => "",
                ),
                "Randomize build props" => false,
                //"New identity"
                //"Scan identity values"
            ),
            "Privacy options﻿    " => array(
                "Password-protect app" => array(
                    "Password" => "",
                    "Ask only once after installation" => false,
                    "Exit app if password is incorrect" => true,
                ),
                "Stealth mode" => false,
                "Stealth mode fingerprint" => false,
                "Fake Calculator" => array(
                    "Enabled" => false,
                    "Code" => "",
                ),
                "Disable accounts access" => false,
                "Disable contacts access" => false,
                "Disable calendar access" => false,
                "Disable call log & SMS access" => false,
                "Exclude from recents" => false,
                "Auto-remove from recents" => false,
                "Incognito mode" => array(
                    "Enabled" => false,
                    "Automatic (when leaving app)" => false,
                ),
                "Spoof location"=>array(
                    "Enabled" => false,
                    "Latitude" => "",
                    "Longitude" => "",
                    "Spoof random location" => "",
                    "Radius (km)" => "",
                    "Use IP location" => false,
                    "10" => "",
                ),
                //"Spoof GPS track﻿    "
                "Hide mock location" => false,
                //"Fake date﻿    "
                //"Fake time"
                //"Freeze time"
                //"Fake time zone"
                "Disable sensors access" => false,
                "Fake environment sensors" => array(
                    "Air temperature (°C)" => "",
                    "Air pressure (hPa / mbar)" => "",
                    "Relative humidity (%)" => "",
                    "Light (lx)" => "",
                ),
                //"Remove permissions"
                //"Disable permission prompts"
                "Disable accessibility access" => false,
                "Prevent screenshots" => false,
                "Prevent screenshot detection" => false,
                "Incognito keyboard" => false,
                "In-app floating keyboard" => false,
                "Keystroke dynamics anonymization" => false,
                "Hide password characters" => false,
                //"Disable auto-fill"
                "Exit app on screen off"=>array(
                    "Exit app on screen off" => false,
                    "Specify delay" => false,
                ),
                //"Sneeze to exit"
                "Hide root" => false,
                //"Hide other apps"
                "Hide all installed apps" => false,
                "Disable Logcat logging" => false,
                "Flush Logcat buffer on exit" => false,
                "Disable in-app search" => false,
                "Disable device administrator" => false,
                "Disable accessibility services" => false,
                "WebView safe browsing" => array(
                    "No change" => true,
                    "Enabled" => false,
                    "Disabled" => false,
                ),
                "Knox Warranty Bit" => array(
                    "No change" => true,
                    "0x1" => false,
                    "0x0" => false,
                ),
            ),
            "Display options﻿    " => array(
                //"Status bar color"
                //"Navigation bar color"
                //"Toolbar color"
                "Invert colors / dark mode" => array(
                    "Enabled" => false,
                    "Exclude WebViews" => false,
                    "Schedule" => false,
                ),
                //"Allow dark mode"
                "Rotation lock" => array(
                    "No change" => true,
                    "No lock (auto)" => false,
                    "Landscape" => false,
                    "Portrait" => false,
                ),
                //"Replace text on screen"
                //"Modify views"
                //"Floating app"
                "Free-form window" => false,
                "Multi-window support" => false,
                "Multi-window no pause" => false,
                "Picture-in-picture support" => false,
                "Keep screen on" => false,
                //"Language"
                "Display size" => 100,
                "Font scale" => 100,
                //"Change default font"
                "Larger aspect ratios" => array(
                    "No change" => true,
                    "Allow" => false,
                    "Disallow" => false,
                ),
                // "Immersive mode" => array(
                // ),
                "Light status bar" => array(
                    "No change" => true,
                    "Enabled" => false,
                    "Disabled" => false,
                ),
                "Flip screen / HUD mode" => array(
                    "Flip screen horizontally" => false,
                    "Flip screen vertically" => false,
                    "Notification" => false,
                    "NFC tag" => false,
                ),
                "Hide notch" => false,
                //"In-app live chat"
                //"Palm rejection"
                //"Add padding"
                "WebView text zoom" => 100,
                "Zoomable image views" => array(
                    "Enabled" => false,
                    "Set maximum scale" => false,
                ),
                "Blur image views" => array(
                    "Disabled" => true,
                    "Low" => false,
                    "Medium" => false,
                    "High" => false,
                    "Tap to reveal & hide, double-tap to reveal permanently" => true,
                    "Long-tap to reveal permanently" => false,
                ),
                //"Skip dialogs﻿    "
                "Hide menu items﻿    " => array(
                    "Enter a string" => "",
                ),
                "Disable nested scrolling" => false,
                //"Splash screen﻿    "
                //"Welcome message"
                //"Remote welcome message"
                "Screen saver" => array(
                    "Enabled" => false,
                    "3" => "",
                    "Exit app" => false,
                    "Mute volume" => false,
                ),
                "No relayout on rotation" => false,
                "Disable fullscreen editing" => false,
                "Keyboard adjust" => array(
                    "No change" => true,
                    "Adjust resize" => false,
                    "Adjust pan" => false,
                    "Adjust nothing" => false,
                ),
                "RTL support" => array(
                    "No change" => true,
                    "Enable" => false,
                    "Disable" => false,
                ),
                //"Color filter"
                //"Wide color gamut"
                "Activity transitions" => array(
                    "No change" => false,
                    "Disable" => false,
                    "Fade" => false,
                    "Zoom" => false,
                    "Shrink" => false,
                    "Split" => false,
                    "Card" => false,
                    "Swipe left" => false,
                    "Swipe right" => false,
                    "In & cut" => false,
                    "Diagonal" => false,
                    "Windmil" => false,
                    "Spin" => true,
                ),
                "Disable hardware acceleration" => false,
            ),
            "Media options﻿    " => array(
                "Mute volume on start" => false,
                "Set volume on start" => array(
                    "Enabled" => false,
                ),
                "Mute while in foreground" => false,
                "Mute for text on screen" => array(
                    "Text" => "",
                ),
                "Prevent app from changing volume" => false,
                "Start sound" => false,
                "Force front / back camera﻿    " => array(
                    "No change" => true,
                    "Force front camera" => false,
                    "Force back camera" => false,
                ),
                //"Disable cameras"
                "Mute mic" => false,
                "Disable audio focus" => false,
                "Disable Chromecast button" => false,
                //"Hide screen mirroring"
                //"Show on secondary display"
                //"Fake camera"
                "Volume rocker locker" => array(
                    "None" => true,
                    "Media" => false,
                    "Ringtone" => false,
                    "Notifications" => false,
                    "Alarm" => false,
                ),
                "Volume control indicator" => array(
                    "None" => true,
                    "Hide" => false,
                    "Toast" => false,
                    "Bar at top" => false,
                    "Bar at bottom" => false,
                    "1" => "",
                ),
                "Disable MediaBrowserService" => false,
                "Disable haptic feedback" => false,
                //"Audio playback capture"
                //"Preferred camera app"
            ),
            "Navigation options﻿    " => array(
                //"Floating Back button"
                "Press Back again to exit" => false,
                "Confirm exit" => false,
                "Minimize on Back" => array(
                    "No change" => true,
                    "Enabled" => false,
                    "Disabled" => false,
                ),
                "Swipe to go back" => array(
                    "Enabled" => false,
                    "To the right" => true,
                    "To the left" => false,
                    "Upwards" => false,
                    "Downwards" => false,
                    "Left border" => false,
                    "Right border" => false,
                    "Top border" => false,
                    "Bottom border" => false,
                    "Anywhere on screen" => false,
                ),
                "Long-press Back action" => array(
                    "None" => true,
                    "Back" => false,
                    "Double back" => false,
                    "Kill app" => false,
                    "Kill app & clear date" => false,
                    "Minimize & hide" => false,
                    "Return to main screen" => false,
                    "Start other app" => false,
                    "Start PIP mode" => false,
                    "Excute Tasker task" => false,
                    "Search" => false,
                ),
                "Legacy options menu﻿    " => array(
                    "Long-press Back for options menu" => false,
                    "Trigger options menu via notification" => false,
                ),
                "Shake action" => array(
                    "None" => true,
                    "Back" => false,
                    "Double back" => false,
                    "Kill app" => false,
                    "Kill app & clear date" => false,
                    "Minimize & hide" => false,
                    "Return to main screen" => false,
                    "Start other app" => false,
                    "Start PIP mode" => false,
                    "Excute Tasker task" => false,
                    "Search" => false,
                ),
                "Back always finishes" => false,
                "Fingerprint tap action" => array(
                    "None" => true,
                    "Back" => false,
                    "Double back" => false,
                    "Kill app" => false,
                    "Kill app & clear date" => false,
                    "Minimize & hide" => false,
                    "Return to main screen" => false,
                    "Start other app" => false,
                    "Start PIP mode" => false,
                    "Excute Tasker task" => false,
                    "Search" => false,
                ),
                "Fingerprint long-tap action" => array(
                    "None" => true,
                    "Back" => false,
                    "Double back" => false,
                    "Kill app" => false,
                    "Kill app & clear date" => false,
                    "Minimize & hide" => false,
                    "Return to main screen" => false,
                    "Start other app" => false,
                    "Start PIP mode" => false,
                    "Excute Tasker task" => false,
                    "Search" => false,
                ),
                "Dismissable dialogs" => array(
                    "No change" => true,
                    "Dismissable" => false,
                    "Not dismissable" => false,
                ),
                "Kiosk mode" => array(
                    "Disabled" => true,
                    "Start via notification" => false,
                    "Start immediately" => false,
                ),
                "Volume up key action" => array(
                    "None" => true,
                    "Back" => false,
                    "Double back" => false,
                    "Kill app" => false,
                    "Kill app & clear date" => false,
                    "Minimize & hide" => false,
                    "Return to main screen" => false,
                    "Start other app" => false,
                    "Start PIP mode" => false,
                    "Excute Tasker task" => false,
                    "Search" => false,
                ),
                "Volume down key action" => array(
                    "None" => true,
                    "Back" => false,
                    "Double back" => false,
                    "Kill app" => false,
                    "Kill app & clear date" => false,
                    "Minimize & hide" => false,
                    "Return to main screen" => false,
                    "Start other app" => false,
                    "Start PIP mode" => false,
                    "Excute Tasker task" => false,
                    "Search" => false,
                ),
                "Volume up & down key action" => array(
                    "None" => true,
                    "Back" => false,
                    "Double back" => false,
                    "Kill app" => false,
                    "Kill app & clear date" => false,
                    "Minimize & hide" => false,
                    "Return to main screen" => false,
                    "Start other app" => false,
                    "Start PIP mode" => false,
                    "Excute Tasker task" => false,
                    "Search" => false,
                ),
                "Popup blocker" => false,
                "Block activities" => array(
                    "Actions or component names" => "",
                ),
                "Activity monitor" => false,
                "Show 'Bring app to front' notification" => false,
            ),
            "Storage options" => array(
                "Install to SD-card" => false,
                "Disable photo & media access" => false,
                "Redirect external storage" => array(
                    "Enabled" => false,
                ),
                "Allow backup" => array(
                    "No change" => true,
                    "Allow" => false,
                    "Don't allow" => false,
                ),
                //"Prompt to keep app data on uninstall"
                //"Bundle app data"
                "Bundle original app" => false,
                //"Bundle files & directories"
                //"Bundle internal files & directories"
                //"Delete files & directories on exit"
                "Clear cache" => array(
                    "Clear cache on exit" => false,
                    "When the app wasn't used for" => false,
                    "3" => "",
                    //days
                ),
                "Disable space management" => false,
                // "Accessible data directory"
                // "File access monitor"
            ),
            "Launching options﻿    " => array(
                "Remove widgets" => false,
                "Remove launcher icon" => false,
                // "Add launcher icons"
                // "Remove launcher icon shortcuts"
                "Auto-start" => array(
                    "No change" => true,
                    "Enabled" => false,
                    "Disabled" => false,
                ),
                "Show app on lock screen" => false,
                // "Show app in power menu"
                "Persistent app" => array(
                    "Enabled" => false,
                    "Create dummy accessibility service" => false,
                ),
                "No background services" => false,
                "Disable app defaults" => false,
                // "Open links with"
                // "File & URL associations﻿    "
                // "Secret dialer code"
                // "Start for outgoing call"
                "Document launch mode" => false,
                "Quick settings tile" => false,
                "Disable wake locks" => false,
                "Job scheduling" => array(
                    "Job scheduling monitor" => false,
                    "Disable job scheduling" => false,
                    "1.0" => "",
                ),
                // "Fake battery level"
                "Request ignore battery optimizations" => false,
                "Make Home app" => false,
                "Make camera app" => false,
                "Make assist app" => false,
                // "S-Pen events"
                // "Headphones events"
                // "Power events"
                "Disable screen on / off events" => false,
                "Disable USB events" => array(
                    "Disabled USB hostt mode events" => false,
                    "Disabled USB accessory mode events" => false,
                ),
                // "Launch app with USB device"
                "Disable NFC events" => false,
                // "Launch app with NFC tag"
                "Launch app when storage is mounted" => array(
                    "Enabled" => true,
                    "Exit app when storage is unmounted" => false,
                ),
                // "Start other app"
                "Request all permissions" => false,
            ),
            "Networking options﻿    " => array(
                //  "Disable all networking"
                 "Enable / disable networking via notification" => false,
                 "Disable mobile data" => false,
                 "Disable background networking" => false,
                 "Disable networking when the screen is off" => false,
                 "Disable networking without VPN" => false,
                 "Mock Wi-Fi connection" => array(
                     "No change" => true,
                     "Connected" => false,
                     "Disconnected" => false,
                 ),
                 "Mock mobile connection" => array(
                    "No change" => true,
                    "Connected" => false,
                    "Disconnected" => false,
                ),
                 "Mock Ethernet connection" => array(
                    "No change" => true,
                    "Connected" => false,
                    "Disconnected" => false,
                ),
                 "Network roaming﻿    " => array(
                    "No change" => true,
                    "Enabled" => false,
                    "Disabled" => false,
                ),
                //  "Hosts blocker"
                //  "Host mapper"
                 "SOCKS proxy" => array(
                     "Proxy host" => "",
                     "1080" => "",
                     "Username" => "",
                     "Password" => "",
                     "Show password" => false,
                 ),
                //  "SOCKS proxy list"
                //  "Hide VPN connection"
                //  "Data directory FTP server"
                 "Override bind address" => array(
                     "No change" => true,
                     "Local interface (127.0.0.1)" => false,
                     "Any interface (0.0.0.0)" => false,
                 ),
                //  "Disable clear-text networking"
                //  "Trust all certificates"
                 "Show IP info" => false,
            ),
            "Notification options" => array(
                "Notification filter" => array(
                    "Block all notifications" => false,
                    "Notification filter" => false,
                ),
                // "Quiet time"
                // "Notification color"
                "Notification sound" => array(
                    "No change" => true,
                    "Default" => false,
                    "Silence" => false,
                    "Custom" => false,
                ),
                "Notification vibration" => array(
                    "No change" => true,
                    "Default" => false,
                    "Silence" => false,
                    "Very short" => false,
                    "Short" => false,
                    "Long" => false,
                    "Very long" => false,
                ),
                // "Notification timeout"
                // "Snooze notifications"
                "Heads-up notifications" => false,
                "Local-only notifications" => false,
                "Ongoing notifications" => array(
                    "No change" => true,
                    "Enabled" => false,
                    "Disabled" => false,
                ),
                "Show notification time" => false,
                "Notification lights" => array(
                    "No change" => true,
                    "On" => false,
                    "Flash (slow)" => false,
                    "Falsh (medium)" => false,
                    "Flash (fast)" => false,
                    "Off" => false,
                    "White" => false,
                    "Red" => false,
                    "Yellow" => false,
                    "Green" => false,
                    "Cyan" => false,
                    "Blue" => false,
                    "Magenta" => false,
                ),
                "Notifications visibility" => array(
                    "No change" => true,
                    "Public" => false,
                    "Private" => false,
                ),
                "Notification priority" => array(
                    "No change" => true,
                    "Maximun" => false,
                    "High" => false,
                    "Default" => false,
                    "Low" => false,
                    "Minimum" => false,
                ),
                "Notification dots" => false,
                "Replace notification icon" => false,
                "Remove notification icon" => false,
                "Remove notification actions" => false,
                "Remove notification people" => false,
                "Simple notifications" => false,
                "Single notification group" => false,
                // "Notification categories"
                // "Single notification category"
                // "Replace notification text"
                "Show toasts as notifications" => false,
                "Toast filter" => array(
                    "Block all toasts" => false,
                    "Toast filter" => "",
                ),
                // "Toast position"
                "Toast duration" => array(
                    "No change" => true,
                    "Short" => false,
                    "Long" => false,
                ),
                // "Toast opacity"
                "Invert toasts" => false,
            ),
            "Game options" => array(
                // "Expansion files"
                // "Preserve expansion files"
                // "GPS joystick"
                // "Key mapper"
                // "FPS monitor"
            ),
            "Android TV options" => array(
                "Android TV launcher support" => false,
                // "Android TV banner image"
                // "Joystick pointer"
                // "Scroll with keyboard"
                "Mark as game" => false,
                // "Picture-in-picture support"
                "Enable TV version" => false,
                "Wear OS options" => false,
                "Remove watch app" => false,
                "Make watch app" => false,
            ),
            "Automation options" => array(
                // "Set brightness on start"
                "Do Not Disturb controls" => array(
                    "Turn on Do NOt Disturb on start" => false,
                    "Restore state on app exit" => false,
                ),
                "Wi-Fi controls" => array(
                    "No change" => true,
                    "Enabled Wi-fi on start" => false,
                    "Disabled Wi-fi on start" => false,
                    "Restore state on app exit" => false,
                ),
                "Bluetooth controls" => array(
                    "No change" => true,
                    "Enabled Bluetooth on start" => false,
                    "Disabled Bluetooth on start" => false,
                    "Restore state on app exit" => false,
                ),
                "Auto-rotate controls" => array(
                    "No change" => true,
                    "Enabled auto-rotate" => false,
                    "Disabled auto-rotate" => false,
                    "Restore state on app exit" => false,
                ),
                "Flashlight while app is open" => false,
                // "Auto-press buttons"
                "Auto-scroller" => false,
                // "Execute Tasker tasks"
            ),
            "Sharing, slection & copy options﻿    " => array(
                "Allow screenshots" => false,
                "Allow text selection" => false,
                "Allow sharing images" => array(
                    "Enabled" => false,
                    "JPEG" => true,
                    "PNG" => false,
                    "Save images directly to gallery" => false,
                    "Scale images to fit" => false,
                ),
                "Disable share actions" => false,
                "Disable text selection actions﻿    " => false,
                "Disable clipboard access" => array(
                    "Disabled read access" => false,
                    "Disabled write access" => false,
                    "Private clipboard" => false,
                    "Persistent clipboard" => false,
                ),
                "Set clipboard data on start" => array(
                    "Text"=>"",
                ),
                "Clipboard timeout" => false,
                "Long-press to copy text" => false,
                "Long-press to enable views" => false,
                "Long-press to reveal password" => false,
                // "Long-press timeout"
                "Always allow copy & paste" => false,
                // "Copy text while scrolling﻿    "
                "Select all on focus" => false,
            ),
            "Manifest & resource options" => array(
                // "Manifest editor"
                // "XML resource editor"
                // "Color editor"
                // "App translator"
                // "Version name"=> array(
                //     "1.62.01" => "",
                // ),
                // "Version code"=> array(
                //     "413835" => "",
                // ),
                // "Minimum SDK version"=> array(
                //     "16" => "",
                // ),
                // "Target SDK version" => array(
                //     "29" => "",
                // ),
                // "Custom permissions"
                // "Custom features"
            ),
            "Developer options" => array(
                // "Make debuggable"
                // "Make WebViews debuggable"
                "Hide developer mode" => false,
                "Logcat viewer" => false,
                // "Override preferences"
                // "Database editor"
                // "Stetho support"
                "Android version" => array(
                    "SDK" => "",
                    "SDK_INT" => "",
                    "PREVIEW SDK_INT" => "",
                    "CODENAME" => "",
                    "INCREMENTAL" => "",
                    "RELEASE" => "",
                    "BASE_OS" => "",
                    "SECURITY_PATCH" => "",
                ),
                "Launch from browser" => array(
                    "Name" => "",
                ),
                // "App valid from"
                // "App valid until"
                "Show touches" => false,
                "Show app info notification" => false,
                // "Sign as system app"
                // "Shared user ID"
                // "Process name"
                // "Custom package name"
                // "Custom certificate"
                // "Hex patcher"
                // "Custom code"
                "WebView URL / data monitor" => array(
                    "Enabled" => false,
                    "Show JavaScript URLs" => false,
                    "Show override URL loading" => false,
                ),
                // "WebView URL / data filter"
                // "WebView override URL loading"
                // "WebView custom script"
                "Send broadcast on start" => array(
                    "Component name" => "",
                ),
                // "Execute shell script"
                "Large heap support" => false,
                "Interpreted mode" => false,
                "Make test only" => false,
            ),
        );
    
        $Database = array(
            "Cloning options﻿    " => array(
                "Cloning mode" => array(
                    "Default" => true,
                    "Manifest" => false,
                ),
                "Skip native libraries" => true,
                "Increase compatibility" => array(
                    "Enabled" => true,
                    "Native method workaround" => true
                ),
                "Ignore crashes" => array(
                    "Ignore crashes" => true,
                    "Show crash messages" => true
                ),
                "Hide the 'Cloned by App Cloner' pop-up" => true,
                "Google Play Services workaround" => true,
                "Hide Google Play Services" => true,
                "Disable Firebase Crashlytics" => true,
                //Hide emulator
                //Disable signature verification
                //Disable license validation﻿
                "Facebook login" => array(
                    "Default" => false,
                    "Web form (recommended)" => false,
                    "Web form (alternative)" => true,
                ),
                "Twitter login"=> array(
                    "Default" => true,
                    "Web form (recommended)" => false,
                ),
                "Disable Chrome Custom Tabs" => true,
                "Local activities" => true,
                "Local broadcasts & services" => true,
                //Single process
                "Package name check workaround" => true,
                "APK check workaround﻿    " => true,
                "Early hooks﻿    " => true,
                "No kill" => array(
                    "Enabled" => true,
                    "Prevent finishing activities" => true
                ),
                "Safe mode" => true,
                //Allow in multi-account apps
                "Hide from Cloned apps" => true,
                "Ignore updates" => true,
            ),
            "Identity & tracking options" => array(
                "Change Android ID" => array(
                    "No change" => false,
                    "Random" => true,
                    "Custom" => false,
                    "Android ID" => "",
                    "Use same settings for Android serial" => true,
                ),
                "Change IMEI / IMSI" =>array(
                    "No change" => false,
                    "Random" => true,
                    "Custom" => false,
                    "IMEI" => "",
                    "Use same settings for IMSI" => true,
                ),
                "Change Wi-Fi MAC address" => array(
                    "No change" => false,
                    "Hide" => true,
                    "Random" => false,
                    "Custom" => false,
                    "MAC address" => "",
                    "Hide Wi-Fi info" => true,
                ),
                "Change Bluetooth MAC address"=>array(
                    "No change" => false,
                    "Hide" => false,
                    "Random" => true,
                    "Custom" => false,
                    "MAC address" => "",
                ),
                "Hide SIM & operator info" => true,
                "Hide GPU info" => false,
                "Change Google Advertising ID"=>array(
                    "No change" => false,
                    "Hide" => false,
                    "Random" => true,
                    "Custom" => false,
                    "Hex value" => "",
                ),
                "Change Google Service Framework (GSF) ID"=>array(
                    "No change" => false,
                    "Hide" => true,
                    "Random" => false,
                    "Custom" => false,
                    "Hex value" => "",
                ),
                "Change WebView User-Agent"=>array(
                    "No change" => false,
                    "Random" => true,
                    "Custom" => false,
                    "Mozilla/5.0 (Linux; Android) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.####.****** Mobile Safari/537.36" => "",
                ),
                "Build props" => array(
                    "MANUFACTURER" => "",
                    "BRAND" => "",
                    "MODEL" => "",
                    "PRODUCT" => "",
                    "DEVICE" => "",
                    "BOARD"=> "",
                    "RADIO" =>"",
                    "HARDWARE" => "",
                    "BOOTLOADER" => "",
                    "FINGERPRINT" => "",
                    "BUILD" => "",
                    "OS VERSION" => "",
                ),
                "Randomize build props" => true,
                //"New identity"
                //"Scan identity values"
            ),
            "Privacy options﻿    " => array(
                "Password-protect app" => array(
                    "Password" => "",
                    "Ask only once after installation" => false,
                    "Exit app if password is incorrect" => true,
                ),
                "Stealth mode" => true,
                "Stealth mode fingerprint" => false,
                "Fake Calculator" => array(
                    "Enabled" => false,
                    "Code" => "",
                ),
                "Disable accounts access" => false,
                "Disable contacts access" => true,
                "Disable calendar access" => true,
                "Disable call log & SMS access" => true,
                "Exclude from recents" => true,
                "Auto-remove from recents" => true,
                "Incognito mode" => array(
                    "Enabled" => true,
                    "Automatic (when leaving app)" => true,
                ),
                "Spoof location"=>array(
                    "Enabled" => false,
                    "Latitude" => "",
                    "Longitude" => "",
                    "Spoof random location" => "",
                    "Radius (km)" => "",
                    "Use IP location" => false,
                    "10" => "",
                ),
                //"Spoof GPS track﻿    "
                "Hide mock location" => true,
                //"Fake date﻿    "
                //"Fake time"
                //"Freeze time"
                //"Fake time zone"
                "Disable sensors access" => true,
                "Fake environment sensors" => array(
                    "Air temperature (°C)" => "",
                    "Air pressure (hPa / mbar)" => "",
                    "Relative humidity (%)" => "",
                    "Light (lx)" => "",
                ),
                //"Remove permissions"
                //"Disable permission prompts"
                "Disable accessibility access" => true,
                "Prevent screenshots" => true,
                "Prevent screenshot detection" => true,
                "Incognito keyboard" => true,
                "In-app floating keyboard" => true,
                "Keystroke dynamics anonymization" => true,
                "Hide password characters" => true,
                //"Disable auto-fill"
                "Exit app on screen off"=>array(
                    "Exit app on screen off" => true,
                    "Specify delay" => true,
                ),
                //"Sneeze to exit"
                "Hide root" => true,
                //"Hide other apps"
                "Hide all installed apps" => true,
                "Disable Logcat logging" => true,
                "Flush Logcat buffer on exit" => true,
                "Disable in-app search" => true,
                "Disable device administrator" => true,
                "Disable accessibility services" => true,
                "WebView safe browsing" => array(
                    "No change" => false,
                    "Enabled" => false,
                    "Disabled" => true,
                ),
                "Knox Warranty Bit" => array(
                    "No change" => false,
                    "0x1" => false,
                    "0x0" => true,
                ),
            ),
            "Display options﻿    " => array(
                //"Status bar color"
                //"Navigation bar color"
                //"Toolbar color"
                "Invert colors / dark mode" => array(
                    "Enabled" => true,
                    "Exclude WebViews" => true,
                    "Schedule" => true,
                ),
                //"Allow dark mode"
                "Rotation lock" => array(
                    "No change" => false,
                    "No lock (auto)" => true,
                    "Landscape" => false,
                    "Portrait" => false,
                ),
                //"Replace text on screen"
                //"Modify views"
                //"Floating app"
                "Free-form window" => false,
                "Multi-window support" => false,
                "Multi-window no pause" => false,
                "Picture-in-picture support" => false,
                "Keep screen on" => false,
                //"Language"
                "Display size" => 100,
                "Font scale" => 100,
                //"Change default font"
                "Larger aspect ratios" => array(
                    "No change" => false,
                    "Allow" => true,
                    "Disallow" => false,
                ),
                // "Immersive mode" => array(
                // ),
                "Light status bar" => array(
                    "No change" => false,
                    "Enabled" => true,
                    "Disabled" => false,
                ),
                "Flip screen / HUD mode" => array(
                    "Flip screen horizontally" => false,
                    "Flip screen vertically" => true,
                    "Notification" => true,
                    "NFC tag" => true,
                ),
                "Hide notch" => true,
                //"In-app live chat"
                //"Palm rejection"
                //"Add padding"
                "WebView text zoom" => 100,
                "Zoomable image views" => array(
                    "Enabled" => true,
                    "Set maximum scale" => true,
                ),
                "Blur image views" => array(
                    "Disabled" => true,
                    "Low" => false,
                    "Medium" => false,
                    "High" => false,
                    "Tap to reveal & hide, double-tap to reveal permanently" => true,
                    "Long-tap to reveal permanently" => false,
                ),
                //"Skip dialogs﻿    "
                "Hide menu items﻿    " => array(
                    "Enter a string" => "",
                ),
                "Disable nested scrolling" => true,
                //"Splash screen﻿    "
                //"Welcome message"
                //"Remote welcome message"
                "Screen saver" => array(
                    "Enabled" => true,
                    "3" => "",
                    "Exit app" => false,
                    "Mute volume" => false,
                ),
                "No relayout on rotation" => true,
                "Disable fullscreen editing" => true,
                "Keyboard adjust" => array(
                    "No change" => false,
                    "Adjust resize" => true,
                    "Adjust pan" => false,
                    "Adjust nothing" => false,
                ),
                "RTL support" => array(
                    "No change" => false,
                    "Enable" => false,
                    "Disable" => true,
                ),
                //"Color filter"
                //"Wide color gamut"
                "Activity transitions" => array(
                    "No change" => false,
                    "Disable" => false,
                    "Fade" => false,
                    "Zoom" => false,
                    "Shrink" => false,
                    "Split" => false,
                    "Card" => false,
                    "Swipe left" => false,
                    "Swipe right" => false,
                    "In & cut" => false,
                    "Diagonal" => false,
                    "Windmil" => false,
                    "Spin" => true,
                ),
                "Disable hardware acceleration" => true,
            ),
            "Media options﻿    " => array(
                "Mute volume on start" => true,
                "Set volume on start" => array(
                    "Enabled" => true,
                ),
                "Mute while in foreground" => true,
                "Mute for text on screen" => array(
                    "Text" => "",
                ),
                "Prevent app from changing volume" => true,
                "Start sound" => false,
                "Force front / back camera﻿    " => array(
                    "No change" => false,
                    "Force front camera" => true,
                    "Force back camera" => false,
                ),
                //"Disable cameras"
                "Mute mic" => true,
                "Disable audio focus" => true,
                "Disable Chromecast button" => true,
                //"Hide screen mirroring"
                //"Show on secondary display"
                //"Fake camera"
                "Volume rocker locker" => array(
                    "None" => false,
                    "Media" => true,
                    "Ringtone" => false,
                    "Notifications" => false,
                    "Alarm" => false,
                ),
                "Volume control indicator" => array(
                    "No change" => false,
                    "Hide" => false,
                    "Toast" => false,
                    "Bar at top" => false,
                    "Bar at bottom" => false,
                    "1" => "",
                ),
                "Disable MediaBrowserService" => true,
                "Disable haptic feedback" => true,
                //"Audio playback capture"
                //"Preferred camera app"
            ),
            "Navigation options﻿    " => array(
                //"Floating Back button"
                "Press Back again to exit" => true,
                "Confirm exit" => true,
                "Minimize on Back" => array(
                    "No change" => false,
                    "Enabled" => true,
                    "Disabled" => false,
                ),
                "Swipe to go back" => array(
                    "Enabled" => true,
                    "To the right" => false,
                    "To the left" => true,
                    "Upwards" => false,
                    "Downwards" => false,
                    "Left border" => false,
                    "Right border" => false,
                    "Top border" => false,
                    "Bottom border" => true,
                    "Anywhere on screen" => true,
                ),
                "Long-press Back action" => array(
                    "None" => true,
                    "Back" => false,
                    "Double back" => false,
                    "Kill app" => false,
                    "Kill app & clear date" => false,
                    "Minimize & hide" => false,
                    "Return to main screen" => false,
                    "Start other app" => false,
                    "Start PIP mode" => false,
                    "Excute Tasker task" => false,
                    "Search" => false,
                ),
                "Legacy options menu﻿    " => array(
                    "Long-press Back for options menu" => false,
                    "Trigger options menu via notification" => false,
                ),
                "Shake action" => array(
                    "None" => true,
                    "Back" => false,
                    "Double back" => false,
                    "Kill app" => false,
                    "Kill app & clear date" => false,
                    "Minimize & hide" => false,
                    "Return to main screen" => false,
                    "Start other app" => false,
                    "Start PIP mode" => false,
                    "Excute Tasker task" => false,
                    "Search" => false,
                ),
                "Back always finishes" => true,
                "Fingerprint tap action" => array(
                    "None" => true,
                    "Back" => false,
                    "Double back" => false,
                    "Kill app" => false,
                    "Kill app & clear date" => false,
                    "Minimize & hide" => false,
                    "Return to main screen" => false,
                    "Start other app" => false,
                    "Start PIP mode" => false,
                    "Excute Tasker task" => false,
                    "Search" => false,
                ),
                "Fingerprint long-tap action" => array(
                    "None" => true,
                    "Back" => false,
                    "Double back" => false,
                    "Kill app" => false,
                    "Kill app & clear date" => false,
                    "Minimize & hide" => false,
                    "Return to main screen" => false,
                    "Start other app" => false,
                    "Start PIP mode" => false,
                    "Excute Tasker task" => false,
                    "Search" => false,
                ),
                "Dismissable dialogs" => array(
                    "No change" => false,
                    "Dismissable" => false,
                    "Not dismissable" => true,
                ),
                "Kiosk mode" => array(
                    "Disabled" => false,
                    "Start via notification" => true,
                    "Start immediately" => false,
                ),
                "Volume up key action" => array(
                    "None" => false,
                    "Back" => false,
                    "Double back" => true,
                    "Kill app" => false,
                    "Kill app & clear date" => false,
                    "Minimize & hide" => false,
                    "Return to main screen" => false,
                    "Start other app" => false,
                    "Start PIP mode" => false,
                    "Excute Tasker task" => false,
                    "Search" => false,
                ),
                "Volume down key action" => array(
                    "None" => false,
                    "Back" => false,
                    "Double back" => false,
                    "Kill app" => false,
                    "Kill app & clear date" => false,
                    "Minimize & hide" => false,
                    "Return to main screen" => false,
                    "Start other app" => false,
                    "Start PIP mode" => false,
                    "Excute Tasker task" => false,
                    "Search" => true,
                ),
                "Volume up & down key action" => array(
                    "None" => true,
                    "Back" => false,
                    "Double back" => false,
                    "Kill app" => false,
                    "Kill app & clear date" => false,
                    "Minimize & hide" => false,
                    "Return to main screen" => false,
                    "Start other app" => false,
                    "Start PIP mode" => false,
                    "Excute Tasker task" => false,
                    "Search" => false,
                ),
                "Popup blocker" => true,
                "Block activities" => array(
                    "Actions or component names" => "",
                ),
                "Activity monitor" => true,
                "Show 'Bring app to front' notification" => true,
            ),
            "Storage options" => array(
                "Install to SD-card" => true,
                "Disable photo & media access" => true,
                "Redirect external storage" => array(
                    "Enabled" => true,
                ),
                "Allow backup" => array(
                    "No change" => false,
                    "Allow" => false,
                    "Don't allow" => true,
                ),
                //"Prompt to keep app data on uninstall"
                //"Bundle app data"
                "Bundle original app" => true,
                //"Bundle files & directories"
                //"Bundle internal files & directories"
                //"Delete files & directories on exit"
                "Clear cache" => array(
                    "Clear cache on exit" => false,
                    "When the app wasn't used for" => false,
                    "3" => "",
                    //days
                ),
                "Disable space management" => true,
                // "Accessible data directory"
                // "File access monitor"
            ),
            "Launching options﻿    " => array(
                "Remove widgets" => true,
                "Remove launcher icon" => false,
                // "Add launcher icons"
                // "Remove launcher icon shortcuts"
                "Auto-start" => array(
                    "No change" => false,
                    "Enabled" => true,
                    "Disabled" => false,
                ),
                "Show app on lock screen" => true,
                // "Show app in power menu"
                "Persistent app" => array(
                    "Enabled" => true,
                    "Create dummy accessibility service" => true,
                ),
                "No background services" => true,
                "Disable app defaults" => true,
                // "Open links with"
                // "File & URL associations﻿    "
                // "Secret dialer code"
                // "Start for outgoing call"
                "Document launch mode" => true,
                "Quick settings tile" => true,
                "Disable wake locks" => true,
                "Job scheduling" => array(
                    "Job scheduling monitor" => true,
                    "Disable job scheduling" => true,
                    "1.0" => "",
                ),
                // "Fake battery level"
                "Request ignore battery optimizations" => true,
                "Make Home app" => true,
                "Make camera app" => true,
                "Make assist app" => true,
                // "S-Pen events"
                // "Headphones events"
                // "Power events"
                "Disable screen on / off events" => true,
                "Disable USB events" => array(
                    "Disabled USB hostt mode events" => true,
                    "Disabled USB accessory mode events" => true,
                ),
                // "Launch app with USB device"
                "Disable NFC events" => true,
                // "Launch app with NFC tag"
                "Launch app when storage is mounted" => array(
                    "Enabled" => true,
                    "Exit app when storage is unmounted" => true,
                ),
                // "Start other app"
                "Request all permissions" => true,
            ),
            "Networking options﻿    " => array(
                //  "Disable all networking"
                 "Enable / disable networking via notification" => true,
                 "Disable mobile data" => true,
                 "Disable background networking" => true,
                 "Disable networking when the screen is off" => true,
                 "Disable networking without VPN" => true,
                 "Mock Wi-Fi connection" => array(
                     "No change" => false,
                     "Connected" => true,
                     "Disconnected" => false,
                 ),
                 "Mock mobile connection" => array(
                    "No change" => false,
                    "Connected" => false,
                    "Disconnected" => true,
                ),
                 "Mock Ethernet connection" => array(
                    "No change" => false,
                    "Connected" => false,
                    "Disconnected" => true,
                ),
                 "Network roaming﻿    " => array(
                    "No change" => false,
                    "Enabled" => true,
                    "Disabled" => false,
                ),
                //  "Hosts blocker"
                //  "Host mapper"
                 "SOCKS proxy" => array(
                     "Proxy host" => "",
                     "1080" => "",
                     "Username" => "",
                     "Password" => "",
                     "Show password" => false,
                 ),
                //  "SOCKS proxy list"
                //  "Hide VPN connection"
                //  "Data directory FTP server"
                 "Override bind address" => array(
                     "No change" => false,
                     "Local interface (127.0.0.1)" => false,
                     "Any interface (0.0.0.0)" => true,
                 ),
                //  "Disable clear-text networking"
                //  "Trust all certificates"
                 "Show IP info" => true,
            ),
            "Notification options" => array(
                "Notification filter" => array(
                    "Block all notifications" => true,
                    "Notification filter" => true,
                ),
                // "Quiet time"
                // "Notification color"
                "Notification sound" => array(
                    "No change" => true,
                    "Default" => false,
                    "Silence" => false,
                    "Custom" => false,
                ),
                "Notification vibration" => array(
                    "No change" => true,
                    "Default" => false,
                    "Silence" => false,
                    "Very short" => false,
                    "Short" => false,
                    "Long" => false,
                    "Very long" => false,
                ),
                // "Notification timeout"
                // "Snooze notifications"
                "Heads-up notifications" => true,
                "Local-only notifications" => true,
                "Ongoing notifications" => array(
                    "No change" => false,
                    "Enabled" => true,
                    "Disabled" => false,
                ),
                "Show notification time" =>true,
                "Notification lights" => array(
                    "No change" => false,
                    "On" =>true,
                    "Flash (slow)" => false,
                    "Falsh (medium)" => false,
                    "Flash (fast)" => false,
                    "Off" => false,
                    "White" => false,
                    "Red" => false,
                    "Yellow" => false,
                    "Green" => false,
                    "Cyan" => false,
                    "Blue" => false,
                    "Magenta" => false,
                ),
                "Notifications visibility" => array(
                    "No change" => false,
                    "Public" => true,
                    "Private" => false,
                ),
                "Notification priority" => array(
                    "No change" => false,
                    "Maximun" => false,
                    "High" => false,
                    "Default" => true,
                    "Low" => false,
                    "Minimum" => false,
                ),
                "Notification dots" => true,
                "Replace notification icon" => true,
                "Remove notification icon" => true,
                "Remove notification actions" => true,
                "Remove notification people" => true,
                "Simple notifications" => true,
                "Single notification group" => true,
                // "Notification categories"
                // "Single notification category"
                // "Replace notification text"
                "Show toasts as notifications" => true,
                "Toast filter" => array(
                    "Block all toasts" => true,
                    "Toast filter" => "",
                ),
                // "Toast position"
                "Toast duration" => array(
                    "No change" => false,
                    "Short" => true,
                    "Long" => false,
                ),
                // "Toast opacity"
                "Invert toasts" => true,
            ),
            "Game options" => array(
                // "Expansion files"
                // "Preserve expansion files"
                // "GPS joystick"
                // "Key mapper"
                // "FPS monitor"
            ),
            "Android TV options" => array(
                "Android TV launcher support" => true,
                // "Android TV banner image"
                // "Joystick pointer"
                // "Scroll with keyboard"
                "Mark as game" => true,
                // "Picture-in-picture support"
                "Enable TV version" => true,
                "Wear OS options" => true,
                "Remove watch app" => true,
                "Make watch app" => true,
            ),
            "Automation options" => array(
                // "Set brightness on start"
                "Do Not Disturb controls" => array(
                    "Turn on Do NOt Disturb on start" => true,
                    "Restore state on app exit" => true,
                ),
                "Wi-Fi controls" => array(
                    "No change" => false,
                    "Enabled Wi-fi on start" => true,
                    "Disabled Wi-fi on start" => false,
                    "Restore state on app exit" => false,
                ),
                "Bluetooth controls" => array(
                    "No change" => false,
                    "Enabled Bluetooth on start" => true,
                    "Disabled Bluetooth on start" => false,
                    "Restore state on app exit" => false,
                ),
                "Auto-rotate controls" => array(
                    "No change" => false,
                    "Enabled auto-rotate" => false,
                    "Disabled auto-rotate" => true,
                    "Restore state on app exit" => true,
                ),
                "Flashlight while app is open" => true,
                // "Auto-press buttons"
                "Auto-scroller" => true,
                // "Execute Tasker tasks"
            ),
            "Sharing, slection & copy options﻿    " => array(
                "Allow screenshots" => true,
                "Allow text selection" => true,
                "Allow sharing images" => array(
                    "Enabled" => true,
                    "JPEG" => false,
                    "PNG" => true,
                    "Save images directly to gallery" => true,
                    "Scale images to fit" => true,
                ),
                "Disable share actions" => true,
                "Disable text selection actions﻿    " => true,
                "Disable clipboard access" => array(
                    "Disabled read access" => true,
                    "Disabled write access" => true,
                    "Private clipboard" => true,
                    "Persistent clipboard" => true,
                ),
                "Set clipboard data on start" => array(
                    "Text"=>"",
                ),
                "Clipboard timeout" => true,
                "Long-press to copy text" => true,
                "Long-press to enable views" => true,
                "Long-press to reveal password" => true,
                // "Long-press timeout"
                "Always allow copy & paste" => true,
                // "Copy text while scrolling﻿    "
                "Select all on focus" => true,
            ),
            "Manifest & resource options" => array(
                // "Manifest editor"
                // "XML resource editor"
                // "Color editor"
                // "App translator"
                // "Version name"=> array(
                //     "1.62.01" => "",
                // ),
                // "Version code"=> array(
                //     "413835" => "",
                // ),
                // "Minimum SDK version"=> array(
                //     "16" => "",
                // ),
                // "Target SDK version" => array(
                //     "29" => "",
                // ),
                // "Custom permissions"
                // "Custom features"
            ),
            "Developer options" => array(
                // "Make debuggable"
                // "Make WebViews debuggable"
                "Hide developer mode" => true,
                "Logcat viewer" => true,
                // "Override preferences"
                // "Database editor"
                // "Stetho support"
                "Android version" => array(
                    "SDK" => "",
                    "SDK_INT" => "",
                    "PREVIEW SDK_INT" => "",
                    "CODENAME" => "",
                    "INCREMENTAL" => "",
                    "RELEASE" => "",
                    "BASE_OS" => "",
                    "SECURITY_PATCH" => "",
                ),
                "Launch from browser" => array(
                    "Name" => "",
                ),
                // "App valid from"
                // "App valid until"
                "Show touches" => true,
                "Show app info notification" => true,
                // "Sign as system app"
                // "Shared user ID"
                // "Process name"
                // "Custom package name"
                // "Custom certificate"
                // "Hex patcher"
                // "Custom code"
                "WebView URL / data monitor" => array(
                    "Enabled" => true,
                    "Show JavaScript URLs" => true,
                    "Show override URL loading" => true,
                ),
                // "WebView URL / data filter"
                // "WebView override URL loading"
                // "WebView custom script"
                "Send broadcast on start" => array(
                    "Component name" => "",
                ),
                // "Execute shell script"
                "Large heap support" => true,
                "Interpreted mode" => true,
                "Make test only" => true,
            ),
        );
        
        //Choose APK to clone
        // $this->byText("android.widget.TextView", $value)->click();

        // //Option Clone
        // //Set $infoClone
        // $this->byText("android.widget.TextView", "Clone number")->click();
        // $this->byText("android.widget.TextView", "BATCH CLONING")->click();
        // $this->elementByXpath("/hierarchy/android.widget.FrameLayout/android.widget.LinearLayout/android.widget.FrameLayout/android.widget.FrameLayout/android.widget.FrameLayout/androidx.appcompat.widget.LinearLayoutCompat/android.widget.FrameLayout/android.widget.FrameLayout/android.widget.ScrollView/android.widget.LinearLayout/android.widget.LinearLayout[2]/android.widget.LinearLayout/android.widget.EditText[2]")->sendKeys($infoClone['numberClone']);
        // if ($infoClone['appendToName'] == true) {
        //     $this->byText("android.widget.CheckBox", "Append clone number to name")->click();
        // }
        // if ($infoClone['iconColor'] == true) {
        //     $this->byText("android.widget.CheckBox", "Change icon color")->click();
        // }
        // if ($infoClone['numberBadge'] == true) {
        //     $this->byText("android.widget.CheckBox", "Set clone number as badge")->click();
        // }
        // $this->byText("android.widget.Button", "OK")->click();
        // $this->byText("android.widget.TextView", "Name")->click();
        // $this->byText("android.widget.EditText", $name)->sendKeys($newname);
        // $this->byText("android.widget.Button", "OK")->click();
        //$this->byText("android.widget.TextView", "Cloning options﻿    ")->click();
        // $dem=0;
        // foreach ($Database as $key => $value) {
        //     $dem++;
        //     if ($dem<4) {
        //         continue;
        //     }
        //     $this->byIDText("android:id/title", $key)->click();
        //     foreach ($value as $key1 => $value1) {
        //         if (!is_array($value1)) {
        //             if ($value1 != $Default[$key][$key1]) {
        //                 $element = $this->byIDText("android:id/title", $key1);
        //                 while ($element == null) {
        //                     $this->swipe(1376, 1423, 1376, 224);
        //                     $element = $this->byIDText("android:id/title", $key1);
        //                 }
        //                 $element->click();
        //             }
        //         } else {
        //             if ($value1 != $Default[$key][$key1]) {
        //                 $element = $this->byIDText("android:id/title", $key1);
        //                 while ($element == null) {
        //                     $this->swipe(1376, 1423, 1376, 224);
        //                     $element = $this->byIDText("android:id/title", $key1);
        //                 }
        //                 $element->click();
        //                 foreach ($value1 as $key2 => $value2) {
        //                     if ($value2 != $Default[$key][$key1][$key2]) {
        //                         $temp = $this->byClassText("android.widget.RadioButton", $key2);
        //                         if ($temp == null) {
        //                             $this->byClassText("android.widget.CheckBox", $key2)->click();
        //                         } else {
        //                             $temp->click();
        //                         }
        //                     }
        //                 }
        //                 $this->byIDText("android:id/button1", "OK")->click();
        //             }
        //         }
        //     }
        //     $this->byAccID("Back")->click();
        // }

        $element = new PHPUnit_Extensions_AppiumTestCase_Element($this->session->getDriver(), $this->session->getSessionUrl());
        $array = $element->bysText("android.widget.TextView");
        // $array = $element->bysClassText("android.widget.RadioButton");
        var_dump($array);
        // var_dump($element->bysText("android.widget.TextView"));

        // $a = new PHPUnit_Extensions_AppiumTestCase_Element($this->session->getDriver(), $this->session->getSessionUrl());
        // $a = $a->by2('class', "android.widget.RadioButton");
        // foreach ($a as $key => $value) {
        //     var_dump($value->attribute("text"));
        //     // if ($value->attribute("text")=="Cloning mode") {
        //     //     $value->click();
        //     //     break;
        //     // }
        //     # code...
        // }
        //$a[1]->attribute("text");
        //$a[1]->click();
    }

    //Element Click
    public function elementClickByXPath($xpath)
    {
        $check = true;
        $this->element = new PHPUnit_Extensions_AppiumTestCase_Element($this->session->getDriver(), $this->session->getSessionUrl());
        while ($check) {
            try {
                $this->element = $this->element->byXPath($xpath);
                $this->element->click();
                $check = false;
            } catch (Exception $e) {
            }
        }
    }

    //Element SendKeys
    public function elementSendKeys($xpath, $value)
    {
        $check = true;
        $this->element = new PHPUnit_Extensions_AppiumTestCase_Element($this->session->getDriver(), $this->session->getSessionUrl());
        while ($check) {
            try {
                $this->element = $this->element->byXPath($xpath);
                $this->element->sendKeys($xpath);
                $check = false;
            } catch (Exception $e) {
            }
        }
    }
    //initiateTouchAction
    public function initiateTouchAction()
    {
        return new PHPUnit_Extensions_AppiumTestCase_TouchAction($this->session->getSessionUrl(), $this->session->getDriver());
    }

    //Swipe
    public function swipe($startX, $startY, $endX, $endY, $duration=800)
    {
        $action = $this->initiateTouchAction();
        $action->press(array('x' => $startX, 'y' => $startY))
               ->wait($duration)
               ->moveTo(array('x' => $endX, 'y' => $endY))
               ->release()
               ->perform();
        return $this;
    }

    public function byAccID($value)
    {
        $this->element = new PHPUnit_Extensions_AppiumTestCase_Element($this->session->getDriver(), $this->session->getSessionUrl());
        return $this->element->byAccID($value);
    }

    public function elementClickBy($strategy, $value)
    {
        $this->element = new PHPUnit_Extensions_AppiumTestCase_Element($this->session->getDriver(), $this->session->getSessionUrl());
        $this->element->element($this->element->using($strategy)->value($value))->click();
    }
    public function startActivity($options)
    {
        $this->session->getSessionUrl()->descend('appium')->descend('device')->descend('start_activity');
        $this->session->getDriver()->curl('POST', $this->url, $options);
    }

    public function elementByXpath($xpath)
    {
        $element = new PHPUnit_Extensions_AppiumTestCase_Element($this->session->getDriver(), $this->session->getSessionUrl());
        return $element->byXPath($xpath);
    }

    public function byIDText($id, $text)
    {
        $this->element = new PHPUnit_Extensions_AppiumTestCase_Element($this->session->getDriver(), $this->session->getSessionUrl());
        return $this->element->byIDText($id, $text);
    }

    public function byClassText($class, $text)
    {
        $this->element = new PHPUnit_Extensions_AppiumTestCase_Element($this->session->getDriver(), $this->session->getSessionUrl());
        return $this->element->byClassText($class, $text);
    }
}
$test = new AutoCloner();
$test->startBluestacks();
//$test->startAppCloner();
$test->startClone();
