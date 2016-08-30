<?php
//$scenario->skip();


$I = new AcceptanceTester( $scenario );

$I->wantTo( 'Test the field conditional logic on the user input step' );


// Submit the form
$I->amOnPage( '/user-input' );

$I->see( 'User Input' );
$I->scrollTo( [ 'css' => '.gform_title' ], 20, 50 ); // needed for chromedriver
$I->fillField( 'Paragraph', 'Some text' );
$I->scrollTo( [ 'css' => 'input[type=submit]' ], 20, 50 ); // needed for chromedriver
// Next page
$I->click( 'Submit' );
$I->see( 'Thanks for contacting us!' );

// Login to wp-admin
$I->loginAsAdmin();
$I->amOnPage( '/wp-admin' );

// Go to Inbox
$I->click( 'Workflow' );
$I->click( 'Inbox' );
//$I->makeScreenshot('inbox');
$I->see( 'Workflow Inbox' );
$I->click( 'User Input' );

$I->selectOption( 'input[name=gravityflow_status]', 'complete' );
$I->click( 'Update' );
// Approve
$I->seeElement( 'div.validation_message' );

// Check field conditional logic on the user input step
$I->see( 'This field is required' );

$I->selectOption( 'input[name=input_13]', 'Second Choice' );

$I->selectOption( 'input[name=gravityflow_status]', 'complete' );
$I->click( 'Update' );
$I->seeElement( 'div.notice-success');
$I->see( 'Entry updated and marked complete' );
