.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.


Users Manual
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^


 1. Install Extension
 2. Make sure the Static Template of the system extension 'form' is included in your Root Template.
 3. Empty the whole Cache
 4. Create a Form using the Wizard - there is a new Accordion called 'Special' with a new element: Grid Element
 5. Add a Grid Element to your form using doubleclick or drag and drop
 6. Determine a css class for the grid - all child elements will be wrapped in a div container with that css class.
 7. Add child elements to it
 8. Save and close the Wizard

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
            <input class="form-control" id="field-4" name="tx_form[asf]" type="text">
        </div>
    </div>


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