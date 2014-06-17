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
				options {
					accordions {
						attributes {
							showProperties := addToList(containerClass)
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
			textline {
				showAccordions := addToList(various)
				accordions {
					attributes {
						showProperties := addToList(class, containerClass)
					}
				}
			}
		}
	}
}