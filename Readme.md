# Formgrids #

## What does it do? ##

This extension adds functionality to the TYPO3 form system extension. It offers the opportunity to arrange form elements in a grid layout. It also integrates itself into the TYPO3 Form Wizard.

## Users Manual ##


 1. Install Extension
 2. Make sure the static TypoScript Template of the system extension 'form' is included in your Root Template.
 3. Include the static TypoScript Template of the extension 'formgrids' right after 'form'
 4. Empty the whole Cache
 5. Create a Form using the Wizard - there is a new Accordion called 'Special' with a new element: Grid Element
 6. Add a Grid Element to your form using doubleclick or drag and drop
 7. Determine a css class for the grid - all child elements will be wrapped in a div container with that css class.
 8. Add child elements to it
 9. Save and close the Wizard

now you can add specific classes for the child elementWraps in the grid. The property is called 'containerClass' and can be added easily int the configuration:

    prefix = tx_form
    confirmation 

...

    10 = GRID    # new Form Element: GRID
    10 {
    	class = row    # class for the wrapper div
    	10 = TEXTLINE
    	10 {
           containerClass = col-md-6    # containerClass for child elements
   		name = name
    		label {
    			value = Name
    		}
    	}
    	20 = TEXTLINE
    	20 {
            containerClass = col-md-6    # containerClass for child elements
    		name = email
    		label {
    			value = Email
    		}
    	}
    }

...

This configuration will output a HTML structure like this:

    <div class="row">
        <div class="col-md-6 form-group csc-form-3 csc-form-element csc-form-element-textline">
            <label for="field-3">Name</label>
            <input class="form-control" id="field-3" name="tx_form[name]" type="text">
        </div>
        <div class="col-md-6 form-group csc-form-4 csc-form-element csc-form-element-textline">
            <label for="field-4">Email</label>
            <input class="form-control" id="field-4" name="tx_form[email]" type="text">
        </div>
    </div>

The Extension adds Typoscript Layout pre-configuration for elementWrap of form elements since correct rendering of grid elements will only work with div elements.
The layout of the form fields can be configured out of the box for the form system extension with typoscript, e.g:

    tt_content.mailform.20.layout {
        form (
			<form role="form">
				<containerWrap />
			</form>
		)
		containerWrap (
			<div class="csc-mailform-container">
				<elements />
			</div>
		)
		elementWrap (
			<div class="form-group">
				<element />
			</div>
		)
		textline (
			<label />
			<input class="form-control" />
		)
		textarea (
			<label />
			<textarea class="form-control" />
		)
		textblock (
			<p class="help-block">
				<textblock />
			</p>
		)
		submit (
			<input class="btn btn-primary" />
		)
    }

In this example, twitter bootstrap css classes are used to get a nice and beautiful form with support of the grid system of the css framework.

### Hints ###

Please make sure that your form elementWrap is rendered as a div tag, not li! Otherwise formgrids won't work!

The form sysext of TYPO3 has a bug, which ignores classes set for elementWrap: https://forge.typo3.org/issues/48404
Without the patch provided in the issue, it is not possible to define a custom class for elementWraps outside a grid element.

## ToDos ##

 - Add support to edit containerClass in the Form Wizard    
