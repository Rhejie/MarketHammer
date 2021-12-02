import cloneDeep from 'lodash/cloneDeep'

export default class ArrayHelper { 
	/**
	 * Flat columns in column editor. 
	 * Should be this format [test: {child: []}]
	 * return flat array.
	 */
	flatColumns(cols, removeChild = true) {
		let columns = cloneDeep(cols)

		columns = columns.reduce((acc, cur) => {
			if (cur.child && !!cur.child.length) acc = [...acc, ...this.flatColumns(cur.child, removeChild)]

			removeChild ? delete cur.child : false

			acc = [...acc, cur]

			return acc
		}, [])

		return columns
	}
}