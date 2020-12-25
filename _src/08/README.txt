===================================================
Packt Publishing - Learning Joomla 3 Extension Development.
                   Chapter 08 source code
                   Security – How to avoid common vulnerabilities 
===================================================

This folder contains the source code for the examples in Chapter 8.

* SQL Injection - contains: 
	modified /components/com_folio/models/folios.php, 
	SQL commands to run in phpMyAdmin, 
	and potential attack URL (change site, table prefix, user id and menu id to suit your site).
	
* LFI - contains:
	/tmp/demo.php file
	folio.vulnerable.php - vulnerable version of /components/com_folio/folio.php
	folio.protected1.php - protected version of /components/com_folio/folio.php using JRequest
	folio.protected2.php - protected version of /components/com_folio/folio.php using JInput
	
* RFI - contains:
	/tmp/demo.txt
	folio.vulnerable.php - vulnerable version of /components/com_folio/folio.php
	folio.protected.php  - protected version of /components/com_folio/folio.php using JInput
	
* XSS - contains:
	/components/com_folio/models/forms/folio.xml - using RAW input filter
	folio.safehtml.xml - /components/com_folio/models/forms/folio.xml - using SAFEHTML input filter
  
* CSRF - contains:
	/components/com_folio/controllers/updfolio.php - with CSRF vulnerability
	/components/com_folio/views/updfolio/tmpl/edit.php - that redirects to http://localhost/joomla3

===================================================
TIM. 03/05/13
===================================================