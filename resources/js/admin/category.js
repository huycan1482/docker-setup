import {Common} from './main.js'

$(document).ready(function () {
    let Category = {
        submitForm: () => {
            let url = 'admin/category/store'
            let data = new FormData();
            let imageFile = document.querySelector('[name="image"]')
            data.append('name', $('input[name="name"]').val())
            data.append('parent_id', $('[name="parent_id"]').find(':selected').val())
            data.append('image', imageFile.files[0])
            data.append('active', ($('[name="active"]:checked').val() && 1) || 0)
            
            Common.addData(url, data)
        },
    }

    $(document).on('click', '*[data-click]', function (e) {
        let func = $(this).data('click');
        switch (func) {
            case 'submitForm':
                Category.submitForm()
                break
        }
    });
});