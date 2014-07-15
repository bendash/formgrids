Ext.namespace('TYPO3.Form.Wizard.Elements.Special');

/**
 * The GRID element
 *
 * @class TYPO3.Form.Wizard.Elements.Special.Grid
 * @extends TYPO3.Form.Wizard.Elements
 */
TYPO3.Form.Wizard.Elements.Special.Grid = Ext.extend(TYPO3.Form.Wizard.Elements, {
	/**
	 * @cfg {String} elementClass
	 * An extra CSS class that will be added to this component's Element
	 */
	elementClass: 'grid',

	/**
	 * @cfg {Mixed} tpl
	 * An Ext.Template, Ext.XTemplate or an array of strings to form an
	 * Ext.XTemplate. Used in conjunction with the data and tplWriteMode
	 * configurations.
	 */
	tpl: new Ext.XTemplate(
		'<div>',
			'<div {[this.getAttributes(values.attributes)]}>',
				'<ol></ol>',
			'</div>',
		'</div>',
		{
			compiled: true,
			getAttributes: function(attributes) {
				var attributesHtml = '';
				Ext.iterate(attributes, function(key, value) {
					if (value) {
						attributesHtml += key + '="' + value + '" ';
					}
				}, this);
				return attributesHtml;
			}
		}
	),

	/**
	 * @cfg {Array} elementContainer
	 * Configuration for the containerComponent
	 */
	elementContainer: {
		hasDragAndDrop: true
	},

	/**
	 * Constructor
	 *
	 * Add the configuration object to this component
	 * @param config
	 */
	constructor: function(config) {
		Ext.apply(this, {
			configuration: {
				attributes: {
					"class": '',
					dir: '',
					id: '',
					lang: '',
					style: ''
				}
			}
		});

		TYPO3.Form.Wizard.Elements.Special.Grid.superclass.constructor.apply(this, arguments);
	},

	/**
	 * Constructor
	 */
	initComponent: function() {
		var config = {};

			// apply config
		Ext.apply(this, Ext.apply(this.initialConfig, config));

			// Initialize the container component
		this.containerComponent = new TYPO3.Form.Wizard.Container(this.elementContainer);

			// call parent
		TYPO3.Form.Wizard.Elements.Special.Grid.superclass.initComponent.apply(this, arguments);

			// Initialize events after rendering
		this.on('afterrender', this.afterRender, this);
	},
	
	/**
	 * Called by the dropzones onContainerDrop or onNodeDrop.
	 * Adds the component to the container.
	 *
	 * This function will look if it is a new element from the left buttons, if
	 * it is an existing element which is moved within this or from another
	 * container. It also decides if it is dropped within an empty container or
	 * if it needs a position within the existing elements of this container.
	 *
	 * @param component
	 * @param position
	 * @param target
	 */
	dropElement: function(component, position, target) {
				
			// Check if there are errors in the current active element
		var optionsTabIsValid = Ext.getCmp('formwizard-left-options').tabIsValid();

		var id = component.id;
		var droppedElement = {};

		if (Ext.get('element-placeholder')) {
			Ext.get('element-placeholder').remove();
		}
			// Only add or move an element when there is no error in the current active element
		if (optionsTabIsValid) {
				// New element in container
			if (position == 'container') {
					// Check if the dummy is present, which means there are no elements
				var dummy = this.findById('dummy');
				if (dummy) {
					this.remove(dummy, true);
				}
					// Add the new element to the container
				if (component.xtype != 'button') {
					droppedElement = this.add(
						component
					);
				} else {
					droppedElement = this.add({
						xtype: 'typo3-form-wizard-elements-' + id
					});
				}

				// Moved an element within this container
			} else if (this.findById(id)) {
				droppedElement = this.findById(id);
				var movedElementIndex = 0;
				var targetIndex = this.items.findIndex('id', target.id);

				if (position == 'above') {
					movedElementIndex = targetIndex;
				} else {
					movedElementIndex = targetIndex + 1;
				}

					// Tricky part, because this.remove does not remove the DOM element
					// See http://www.sencha.com/forum/showthread.php?102190
					// 1. remove component from container w/o destroying (2nd argument false)
					// 2. remove component's element from container and append it to body
					// 3. add/insert the component to the correct place back in the container
					// 4. call doLayout() on the container
				this.remove(droppedElement, false);
				var element = Ext.get(droppedElement.id);
				element.appendTo(Ext.getBody());

				this.insert(
					movedElementIndex,
					droppedElement
				);

				// New element for this container coming from another one
			} else {
				var index = 0;
				var targetIndex = this.items.findIndex('id', target.id);

				if (position == 'above') {
					index = targetIndex;
				} else {
					index = targetIndex + 1;
				}

					// Element moved
				if (component.xtype != 'button') {
					droppedElement = this.insert(
						index,
						component
					);
					// Coming from buttons
				} else {
					droppedElement = this.insert(
						index,
						{
							xtype: 'typo3-form-wizard-elements-' + id
						}
					);
				}
			}
			this.doLayout();
			TYPO3.Form.Wizard.Helpers.History.setHistory();
			TYPO3.Form.Wizard.Helpers.Element.setActive(droppedElement);

			// The current active element has errors, show it!
		} else {
			Ext.MessageBox.show({
				title: TYPO3.l10n.localize('options_error'),
				msg: TYPO3.l10n.localize('options_error_message'),
				icon: Ext.MessageBox.ERROR,
				buttons: Ext.MessageBox.OK
			});
		}
	},

	/**
	 * Called by the 'afterrender' event.
	 *
	 * Add the container component to this component
	 */
	afterRender: function() {
		this.addContainerAfterRender();

		// Call parent
		TYPO3.Form.Wizard.Elements.Basic.Form.superclass.afterRender.call(this);
	},

	/**
	 * Add the container component to this component
	 *
	 * Because we are using a XTemplate for rendering this component, we can
	 * only add the container after rendering, because the <ol> tag needs to be
	 * replaced with this container.
	 *
	 * The container needs to be rerendered when a configuration parameter
	 * (legend or attributes) of the ownerCt, for instance fieldset, has changed
	 * otherwise it will not show up
	 */
	addContainerAfterRender: function() {
		this.containerComponent.applyToMarkup(this.getEl().child('ol'));
		this.containerComponent.rendered = false;
		this.containerComponent.render();
		this.containerComponent.doLayout();
	}
});

Ext.reg('typo3-form-wizard-elements-special-grid', TYPO3.Form.Wizard.Elements.Special.Grid);