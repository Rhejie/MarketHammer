import axios from 'axios'

export default {
	/**
	 * API endpoint to create new business certification
	 *
	 * @param postData <object> - the data to be saved
	 *
	 * @return Promise
	 */
	createNewCertification(postData) {
		let form = new FormData()

		for (let x in postData) {
			if (x === 'files' && postData[x].length > 0) {
				for (let file of postData[x]) {
					form.append('fileList[]', file.raw)
				}

				continue
			}

			form.append(x, postData[x])
		}

		return axios.post(`/business-certification`, form);
	},

	/**
	 * API endpoint to update business certification
	 *
	 * @param postData <object> - the data to be saved
	 * @param id <string> - the business address data that will be updated
	 *
	 * @return Promise
	 */
	updateCertification(postData, id) {
		let form = new FormData()

		for (let x in postData) {
			if (x === 'files' && postData[x].length > 0) {
				for (let file of postData[x]) {
					file.raw ? form.append('fileList[]', file.raw) : null
					file.id ? form.append('savedFiles[]', JSON.stringify(file)) : null
				}

				continue
			}
			
			form.append(x, postData[x])	
		}

		return axios.post(`/business-certification/${id}`, form);
	},

	/**
	 * Export business certifications 
	 *
	 * @return Promise
	 */
	exportCertifications(postData) {
		return axios({
			method: 'post',
			url: `/business-certification/export-certifications`,
			responseType: 'blob',
			data: postData
		})
	},

	/**
	 * Handle delete business certification
	 *
	 * @param id <string> - id
	 *
	 * @return <Promise>
	 */
	deleteCertification(id) {
		return axios.delete(`/business-certification/${id}`)
	},

	/**
	 * Retrieve list of business certifications
	 *
	 * @param postData <object> - this will be used to filter the response data
	 *
	 * @return Promise
	 */
	getCertifications(postData) {
		return axios.post(`/business-certification/get-certifications`, postData)
	}
}