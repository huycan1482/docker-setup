    
   export const Common = {
        config: {
            busy: false,
            sending: false,
            uri: window.location.origin,
        },
        load: (action = 'hide') => {
            if (action === 'show') {

            } else {

            }
        },
        
        addData: (url, data) => {
            Axios({
                method: 'POST',
                url: url,
                data: data
            }).then(function (response) {
                let res = response.data
                if (res.success) {

                } else {

                }
            }).catch(function (error) {
                Swal.fire({
                    title: "Error",
                    text: "Error",
                    icon: "error"
                  });
            });
        },
        handlerStoreError: (data) => {

        },
    }

    export const Axios = axios.create({
        baseURL: Common.config.uri,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Content-Type': 'multipart/form-data',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });

    Axios.interceptors.request.use(function (config) {
        return config;
    }, function (error) {
        return Promise.reject(error);
    });

    export const escapeHTML = (text) => {
        let replacements= {"<": "&lt;", ">": "&gt;","&": "&amp;", '"': "&quot;"};                      
        return text.replace(/[<>&"]/g, function(character) {  
            return replacements[character];  
        }); 
    }

    export const haveSameContents = (a, b) => {
        for (const v of new Set([...a, ...b]))
            if (a.filter(e => e === v).length !== b.filter(e => e === v).length) return false;
        return true;
    };

    export const isContainedIn = (a, b) => {
        for (const v of new Set(a)) {
            if (!b.some(e => e === v) || a.filter(e => e === v).length > b.filter(e => e === v).length)
                return false;
        }
        return true;
    };

    

