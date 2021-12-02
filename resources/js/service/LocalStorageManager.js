/**
 * This class will be used on localstorage purposes.
 * This inline with the preparation on table column
 * settings display and could other possible
 * upcomming additional modules and functions.
*/

import has from 'lodash/has'
/**
 * If you want to add another entry to our LocalStorage,
 * declare the key to this variable. And if possible set
 * default values or declare the type.
*/
let columnKeys = {
		businessListColumnManager: [], // Employee List column manager
}
const storageName = "MARKETHAMMER_LOCALSTORAGE_ENTRY"

export default class LocalStorageManager {
	/**
	 * This will check if our local storage entry
	 * is set, if not, set. This will prevent possible errors.
	*/
	constructor() {
		if (!localStorage.getItem(storageName)) {
			localStorage.setItem(storageName, JSON.stringify(columnKeys))
		} else {
			let parsed = JSON.parse(localStorage.getItem(storageName))
			if (Object.keys(columnKeys).length !== Object.keys(parsed).length) {
				localStorage.setItem(storageName, JSON.stringify(columnKeys))
				parsed = JSON.parse(localStorage.getItem(storageName))
			}
			columnKeys = parsed
		}
	}

	/**
	 * Will check whether a certain value exists
	 * in a particular key
	 * param keyName - the name of the key you want to check
	 * 
	*/
	checkValue(keyName) {
		let result = true
		let localData = JSON.parse(localStorage.getItem(storageName))

		if (localData[keyName]) {
			if (localData[keyName].length <= 0) result = false
		} else {
			result = false
		}

		return result
	}

	/**
	 * Verify if a key is registered
	 */
	verifyIfKeyRegistered(keyName) {
		return keyName in columnKeys
	}

	/**
	 * This will retrieve a specific entry or key 
	 * to the local storage. If no entry found it will return false
	 * param keyName - the name of the key you want to retrieve with its data
	 * return result mixed
	*/
	retrieveSpecificEntry(keyName) {
		let result = false
		let localData = JSON.parse(localStorage.getItem(storageName))

		if (has(localData ,keyName)) {
			return localData[keyName]
		}

		return result
	}

	/**
	 * Will udpate the local storage data
	 * param keyName - the name of the key that is to be updated
	 * param data - the data to replaced
	*/
	updateLocalStorageEntry(keyName, data) {
		columnKeys[keyName] = data
		localStorage.setItem(storageName, JSON.stringify(columnKeys))
	}

	/**
	 * Return list of registered keys
	 */
	registeredKeys() {
		return columnKeys
	}

	getTinymceInitSettings(keys, theme = null){
		/*defaults 
			menu : {
			    file: { title: 'File', items: 'newdocument restoredraft | preview | print ' },
			    edit: { title: 'Edit', items: 'undo redo | cut copy paste | selectall | searchreplace' },
			    view: { title: 'View', items: 'code | visualaid visualchars visualblocks | spellchecker | preview fullscreen' },
			    insert: { title: 'Insert', items: 'image link media template codesample inserttable | charmap emoticons hr | pagebreak nonbreaking anchor toc | insertdatetime' },
			    format: { title: 'Format', items: 'bold italic underline strikethrough superscript subscript codeformat | formats blockformats fontformats fontsizes align | forecolor backcolor | removeformat' },
			    tools: { title: 'Tools', items: 'spellchecker spellcheckerlanguage | code wordcount' },
			    table: { title: 'Table', items: 'inserttable | cell row column | tableprops deletetable' },
			    help: { title: 'Help', items: 'help' }
			}*/

		let contentStyle = "body { font-family: Inter-Medium, Helvetica, sans-serif; font-size: 12px; color: #5f5f5f}"
		let activeTheme = theme || localStorage.getItem('witty_theme')

		if(activeTheme == 'dark') {
			contentStyle = "body { font-family: Inter-Medium, Helvetica, sans-serif; font-size: 12px; color: white}"
		}

		let init = {
			menu : {
			    file: { title: 'File', items: 'newdocument restoredraft | preview | print ' },
			    edit: { title: 'Edit', items: 'undo redo | cut copy paste | selectall | searchreplace' },
			    view: { title: 'View', items: 'visualaid visualchars visualblocks | spellchecker | preview fullscreen' },
			    //insert: { title: 'Insert', items: 'image link media template codesample inserttable | charmap emoticons hr | pagebreak nonbreaking anchor toc | insertdatetime' },
			    insert: { title: 'Insert', items: 'image link media codesample inserttable | charmap emoticons hr | pagebreak nonbreaking anchor toc | insertdatetime' },
			    format: { title: 'Format', items: 'fontselect bold italic underline strikethrough superscript subscript codeformat | formats blockformats fontformats fontsizes align | forecolor backcolor | removeformat' },
			    tools: { title: 'Tools', items: 'spellchecker spellcheckerlanguage wordcount' },
			    table: { title: 'Table', items: 'inserttable | cell row column | tableprops deletetable' },
			    help: { title: 'Help', items: 'help' }
			},
			content_style: contentStyle,
			inline_styles : true,
			font_formats: "Andale Mono=andale mono,times; Arial=arial,helvetica,sans-serif; Arial Black=arial black,avant garde; Book Antiqua=book antiqua,palatino; Comic Sans MS=comic sans ms,sans-serif; Courier New=courier new,courier; Georgia=georgia,palatino; Helvetica=helvetica; Impact=impact,chicago; Symbol=symbol; Tahoma=tahoma,arial,helvetica,sans-serif; Terminal=terminal,monaco; Times New Roman=times new roman,times; Trebuchet MS=trebuchet ms,geneva; Verdana=verdana,geneva; Webdings=webdings; Wingdings=wingdings,zapf dingbats",
		}

		if(keys){
			if(keys.height){
				init['height'] = keys.height
			}
			
			if(keys.menubar || keys.menubar == false){
				init['menubar'] = keys.menubar
				if(keys.menubar == false) {
					init.menu = false
				}
			}

			if(keys.autoresize_on_init || keys.autoresize_on_init == false) {
				init['autoresize_on_init'] = keys.autoresize_on_init
			}
			
		}

		return init
	}

	// additionalPlugins => (string) list of plugins separated by a space
	getTinymcePluginList(additionalPlugins) {
		let pluginList = [
			'advlist autolink lists link image charmap print preview hr anchor pagebreak', 
			'searchreplace wordcount visualblocks visualchars code fullscreen', 
			'insertdatetime media nonbreaking save table contextmenu directionality',
			'template paste textcolor colorpicker textpattern imagetools toc help emoticons hr codesample'
		]

		if(additionalPlugins && additionalPlugins != '') {

			if(additionalPlugins.length) {
				pluginList = pluginList.concat(additionalPlugins)
			} else {
				pluginList.push(additionalPlugins)
			}
		}

		return [pluginList]
	}
}