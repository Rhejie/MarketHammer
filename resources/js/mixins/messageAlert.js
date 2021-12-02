window.noty = require('noty')
import Noty from 'noty'

export default {
      methods: {
        showMessage(type = 'error', message, time = 3000) {
            /*$.noty.defaults = {
                layout: 'top',
                theme: 'defaultTheme', // or relax
                type: 'alert', // success, error, warning, information, notification
            }*/

            new Noty({
                theme: 'relax',
                type: type,
                layout: 'topRight',
                text: message,
                timeout: time
            }).show();
        },
    }
}