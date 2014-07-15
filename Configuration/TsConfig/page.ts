mod.wizards {
    form {
		defaults {
			tabs {
				elements {
					showAccordions := addToList(special)
					accordions {
						special {
							showButtons = grid
						}
					}
				}
			}
		}
		elements {
			grid {
				showAccordions = attributes
				accordions {
					attributes {
						showProperties = class
					}
				}
			}
			textline.showAccordions := addToList(grid)
			textarea.showAccordions := addToList(grid)
			checkboxgroup.showAccordions := addToList(grid)
			checkbox.showAccordions := addToList(grid)
			radiogroup.showAccordions := addToList(grid)
			radio.showAccordions := addToList(grid)
			fieldset.showAccordions := addToList(grid)
			fileupload.showAccordions := addToList(grid)
			password.showAccordions := addToList(grid)
			email.showAccordions := addToList(grid)
			header.showAccordions := addToList(grid)
			textblock.showAccordions := addToList(grid)
		}
	}
}