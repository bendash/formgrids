Ext.namespace('TYPO3.Form.Wizard.Viewport.Left.Elements');

/**
 * The content elements in the elements tab on the left side
 *
 * @class TYPO3.Form.Wizard.Viewport.Left.Elements.Special
 * @extends TYPO3.Form.Wizard.Viewport.Left.Elements.ButtonGroup
 */
TYPO3.Form.Wizard.Viewport.Left.Elements.Special = Ext.extend(TYPO3.Form.Wizard.Viewport.Left.Elements.ButtonGroup, {
	/**
	 * @cfg {String} id
	 * The unique id of this component (defaults to an auto-assigned id).
	 * You should assign an id if you need to be able to access the component
	 * later and you do not have an object reference available
	 * (e.g., using Ext.getCmp).
	 *
	 * Note that this id will also be used as the element id for the containing
	 * HTML element that is rendered to the page for this component.
	 * This allows you to write id-based CSS rules to style the specific
	 * instance of this component uniquely, and also to select sub-elements
	 * using this component's id as the parent.
	 */
	id: 'formwizard-left-elements-special',

	/**
	 * @cfg {String} title
	 * The title text to be used as innerHTML (html tags are accepted) to
	 * display in the panel header (defaults to '').
	 */
	title: 'Special', //TYPO3.l10n.localize('left_elements_content')

	/**
	 * Constructor
	 *
	 * Add the buttons to the accordion
	 */
	initComponent: function() {
		var allowedButtons = TYPO3.Form.Wizard.Settings.defaults.tabs.elements.accordions.special.showButtons.split(/[, ]+/);
		var buttons = [];

		allowedButtons.each(function(option, index, length) {
			switch (option) {
				case 'grid':
					buttons.push({
						text: 'Grid Element', //TYPO3.l10n.localize('special_grid')
						id: 'special-grid',
						clickEvent: 'dblclick',
						handler: this.onDoubleClick,
						iconCls: 'formwizard-left-elements-special-grid',
						scope: this
					});
					break;
			}
		}, this);

		var config = {
			items: buttons
		};

			// apply config
		Ext.apply(this, Ext.apply(this.initialConfig, config));

			// call parent
		TYPO3.Form.Wizard.Viewport.Left.Elements.Special.superclass.initComponent.apply(this, arguments);
	}
});

Ext.reg('typo3-form-wizard-viewport-left-elements-special', TYPO3.Form.Wizard.Viewport.Left.Elements.Special);