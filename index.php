<?php

include_once('vendor/autoload.php');

//Get a new object and pass the file in constructor
$instance = new \pYaml\pYaml("config.yaml");

//Initialize a new nodeSelector and pass this object to pYaml class get() function
$selector = new \pYaml\nodeSelector\nodeSelector("array");
$section = $instance->get($selector);

//Set a value in parsed file, and save the result to output.yaml
//This need a valid selector (to insert a new value), but if you
//want to edit a value, validate the selector first.
//To run validator with own selector must be call the get() method first
if($selector->isValid("database.type")) {
    //Set a defined key, by validating the selector first
    $instance->set("database.type", "pgsq");
}

//Set a new key to the file and save the result to out.yaml
$instance->set("test2.newvalue", "Yest, its a new valueeeee")->save("out.yaml");

//Detect the selector is valid or not
if($selector->isValid()) {
    echo "<b>This selector is valid!</b><br />";

    //Detect the selector has a parent
    if($selector->hasParent()) {
        echo "This selector has the following parent: <b>" . $selector->getParentName() . "</b><br /><br />";
    } else {
        echo "<b>This selector has no parent!</b><br /><br />";
    }

    if($section->isArray()) {
        echo "<b>The result is an array!</b><br />";
        echo "<b>And this is the first element of the result:</b> " . $section->getArray()->getIterator()->current();
        exit;
    }

    if($section->isBoolean()) {
        echo "<b>The result is a boolean value!</b><br />";
        echo "<b>And this is the result:</b> " . $section->getBoolean();
        exit;
    }

    if($section->isInt()) {
        echo "<b>The result is a integer!</b><br />";
        echo "<b>And this is the result:</b> " . $section->getInt();
        exit;
    }

    if($section->isString()) {
        echo "<b>The result is a string!</b><br />";
        echo "<b>And this is the result:</b> " . $section->getString();
        exit;
    }

    if($section->isList()) {
        echo "<b>The result is a list!</b><br />";
        echo "<b>And this is the first element of the result:</b> " . $section->getList()->getIterator()->current();
        exit;
    }
} else {
    //Report the error
    die("<b>This selector is not valid!<br />Error found this part of the selector:</b> " . $selector->getErrorNode() . "<br /><b>Complete selector:</b> " . $selector->getSelectorString());
}