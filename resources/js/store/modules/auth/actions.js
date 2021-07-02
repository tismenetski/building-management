let timer; // this is a global variable to make sure we only use one instance of this timer accross this code.

export default {
    /**
     * Function to start the signup process.this is called from the auth registration process
     * @param {*} context the context decides whether to go to signup or to login,depends on payload mode value
     * @param {*} payload the params that passed from the registration form , hence email and password
     * @returns
     */
    async signup(context, payload) {
        let url ='api/register';

        const response = await fetch(url, {
            method: 'POST',
            body: JSON.stringify( {
                name : payload.name,
                email: payload.email,
                password: payload.password,
            }),
            headers: {
                'Content-Type': 'application/json'
            },
        });
        const responseData = await response.json();
        console.log(responseData);
        console.log('Printed Response Data');

        // response object have ok field, we check for this field, if not existing we know we have an error;
        // this error handling is made so that will throw our error to to top component and from there we try catch the error
        if (!response.ok) {
            //console.log('RESPONSE NOT OK' + responseData);
            const error = new Error(responseData.message || 'Cannot Signup');
            throw error;
        }

        localStorage.setItem('token', responseData.token);

        context.commit('setUser', {
            token: responseData.token,
        });

    },
    /**
     * Function to start the login process.this is called from the auth registration process
     * @param {*} context
     * @param {*} payload
     * @returns
     */
    async login(context, payload) {

        let url ='/api/login';

        const response = await fetch(url, {
            method: 'POST',
            body: JSON.stringify( {
                email: payload.email,
                password: payload.password,
            }),
            headers: {
                'Content-Type': 'application/json'
            },
        });

        const responseData = await response.json();
        console.log(responseData);
        console.log('Printed Response Data');


        // response object have ok field, we check for this field, if not existing we know we have an error;
        // this error handling is made so that will throw our error to to top component and from there we try catch the error
        if (!response.ok) {
            //console.log('RESPONSE NOT OK' + responseData);
            const error = new Error(responseData.message || 'Cannot Signup');
            throw error;
        }
        localStorage.setItem('token', responseData.token);

        context.commit('setUser', {
            token: responseData.token,
        });
    },

    /**
     *
     * @param {*} context calls the setUser mutation to set all user credentials to null
     * @returns
     */
    logout(context) {
        localStorage.removeItem('token');

        clearTimeout(timer); // clears the timer, the time of token expiration remaining

        return context.commit('setUser', {
            token: null,
            userId: null
        });
    },
    /**
     * Function does same action for signup and login, just accepts a mode parameter
     * from the payload with 'login' or 'signup' to figure to which url to go
     * @param {*} context
     * @param {*} payload
     */
    // async auth(context, payload) {
    //     const mode = payload.mode;
    //     let url =
    //         '/api/login';
    //     if (mode === 'signup') {
    //         url =
    //             'api/register';
    //     }
    //     const response = await fetch(url, {
    //         method: 'POST',
    //         body: JSON.stringify( {
    //             name : payload.name,
    //             email: payload.email,
    //             password: payload.password,
    //         }),
    //         headers: {
    //             'Content-Type': 'application/json'
    //         },
    //     });
    //     //console.log(response.data);
    //     const responseData = await response.json();
    //     console.log(responseData);
    //     console.log('Printed Response Data');
    //     //console.log(response.data);
    //     //console.log(response);
    //
    //     // response object have ok field, we check for this field, if not existing we know we have an error;
    //     // this error handling is made so that will throw our error to to top component and from there we try catch the error
    //     if (!response.ok) {
    //         //console.log('RESPONSE NOT OK' + responseData);
    //         const error = new Error(responseData.message || 'Cannot Signup');
    //         throw error;
    //     }
    //
    //     // const expiresIn = +responseData.expiresIn * 1000;
    //     // const expirationDate = new Date().getTime() + expiresIn;
    //
    //     localStorage.setItem('token', responseData.token);
    //     // localStorage.setItem('userId', responseData.localId);
    //     // localStorage.setItem('tokenExpiration', expirationDate);
    //
    //     // auto logout the user after the timer of the token expires
    //     // timer = setTimeout(function() {
    //     //     context.dispatch('autoLogout');
    //     // }, expiresIn);
    //
    //     context.commit('setUser', {
    //         token: responseData.token,
    //         // userId: responseData.localId
    //     });
    // },

    /**
     * This function is called when the application is being loaded, checks if local Storage have token and userId and sets them in the
     * setUser mutation
     * @param {*} context
     * @returns
     */
    tryLogin(context) {
        const token = localStorage.getItem('token');
        // const userId = localStorage.getItem('userId');
        // const tokenExpiration = localStorage.getItem('tokenExpiration');
        //
        // const expiresIn = +tokenExpiration - new Date().getTime();
        //
        // if (expiresIn < 0) {
        //     return;
        // }
        //
        // timer = setTimeout(function() {
        //     context.dispatch('autoLogout');
        // }, expiresIn);

        if (token) {
            context.commit('setUser', {
                token,
            });
        }
    },
    autoLogout(context) {
        context.dispatch('logout');
        context.commit('setAutoLogout');
    }
};
