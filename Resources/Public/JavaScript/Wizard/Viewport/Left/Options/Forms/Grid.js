Ext.namespace('TYPO3.Form.Wizard.Viewport.Left.Options.Forms');

/**
 * The grid properties of the element
 *
 * @class TYPO3.Form.Wizard.Viewport.Left.Options.Forms.Grid
 * @extends Ext.FormPanel
 */
TYPO3.Form.Wizard.Viewport.Left.Options.Forms.Grid = Ext.extend(Ext.FormPanel, {
	/**
	 * @cfg {String} title
	 * The title text to be used as innerHTML (html tags are accepted) to
	 * display in the panel header (defaults to '').
	 */
	title: TYPO3.l10n.localize('options_grid'),

	/** @cfg {String} defaultType
	 *
	 * The default xtype of child Components to create in this Container when
	 * a child item is specified as a raw configuration object,
	 * rather than as an instantiated Component.
	 *
	 * Defaults to 'panel', except Ext.menu.Menu which defaults to 'menuitem',
	 * and Ext.Toolbar and Ext.ButtonGroup which default to 'button'.
	 */
	defaultType: 'textfield',

	/**
	 * @cfg {Boolean} monitorValid If true, the form monitors its valid state client-side and
	 * regularly fires the clientvalidation event passing that state.
	 * When monitoring valid state, the FormPanel enables/disables any of its configured
	 * buttons which have been configured with formBind: true depending
	 * on whether the form is valid or not. Defaults to false
	 */
	monitorValid: true,

	/**
	 * Constructor
	 *
	 * Add the form elements to the accordion
	 */
	initComponent: function() {
		var grid = this.element.configuration.grid;
		var formItems = new Array();

			// Adds the specified events to the list of events which this Observable may fire.
		this.addEvents({
			'validation': true
		});

		Ext.iterate(grid, function(key, value) {
			switch(key) {
				case 'containerClass':
					formItems.push({
						fieldLabel: TYPO3.l10n.localize('grid_properties_containerclass'),
						name: 'containerClass',
						allowBlank: true,
						listeners: {
							'triggerclick': {
								scope: this,
								fn: this.storeValue
							}
						}
					});
					break;
			}
		}, this);
		
		var config = {
			items: [{
				xtype: 'fieldset',
				title: '',
				autoHeight: true,
				border: false,
				defaults: {
					width: 150,
					msgTarget: 'side'
				},
				defaultType: 'textfieldsubmit',
				items: formItems
			}]
		};

			// apply config
		Ext.apply(this, Ext.apply(this.initialConfig, config));

			// call parent
		TYPO3.Form.Wizard.Viewport.Left.Options.Forms.Grid.superclass.initComponent.apply(this, arguments);

			// Initialize clientvalidation event
		this.on('clientvalidation', this.validation, this);

			// Fill the form with the configuration values
		this.fillForm();
	},

	/**
	 * Store a changed value from the form in the element
	 *
	 * @param {Object} field The field which has changed
	 */
	storeValue: function(field) {
		if (field.isValid()) {
			var fieldName = field.getName();

			var formConfiguration = {grid: {}};
			formConfiguration.grid[fieldName] = field.getValue();

			this.element.setConfigurationValue(formConfiguration);
		}
	},

	/**
	 * Fill the form with the configuration of the element
	 *
	 * @return void
	 */
	fillForm: function() {
		this.getForm().setValues(this.element.configuration.grid);
	},

	/**
	 * Called by the clientvalidation event
	 *
	 * Adds or removes the error class if the form is valid or not
	 *
	 * @param {Object} formPanel This formpanel
	 * @param {Boolean} valid True if the client validation is true
	 */
	validation: function(formPanel, valid) {
		if (this.el) {
			if (valid && this.el.hasClass('validation-error')) {
				this.removeClass('validation-error');
				this.fireEvent('validation', 'grid', valid);
			} else if (!valid && !this.el.hasClass('validation-error')) {
				this.addClass('validation-error');
				this.fireEvent('validation', 'grid', valid);
			}
		}
	}
});

Ext.reg('typo3-form-wizard-viewport-left-options-forms-grid', TYPO3.Form.Wizard.Viewport.Left.Options.Forms.Grid);