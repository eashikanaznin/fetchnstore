CONTENTS OF THIS FILE
---------------------

 * Introduction
 * Requirements
 * Installation
 * Configuration
 * Maintainers


INTRODUCTION
------------
The job builder module imports data from a drupal 9 sites's REST api and inserts in a given content type. 
The module provides a settings page where the import can be done manually by clicking "Import Now" button.
On form submit a curl request gets generated and through a loop contents are created in "opportunity" content type.
Although not required for this particular module, views module can be used to generated a listing page for the opportunity content type

Scope of improvement:
 * work in progress; please add "delete previous records" and "add to previous records" options in setting form
 * needs work on error handling

REQUIREMENTS
------------

This module requires "keys" module outside of Drupal core.


INSTALLATION
------------
* [Views](https://www.drupal.org/project/views)
* [keys](https://www.drupal.org/project/key)



CONFIGURATION
-------------

    1. Module can me manually enabled from "Extend"; also can be enabled through drush command
	"drush en job_builder"
    2.Add the API key in the key modue's dashboard. the id should be "displayadvartapi"
    3. Navigate to Administration > Configuration > System > Import opportunity content to see the settings form


MAINTAINERS
-----------

 * Eashika Naznin - eashika07@gmail.com

