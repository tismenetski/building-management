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
        localStorage.setItem('role', responseData.role === 1 ? 'admin' : 'user');

        context.commit('setUser', {
            token: responseData.token,
            role : responseData.role === 1 ? 'admin' : 'user'
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
            role: ''
        });
    },
    /**
     * This function is called when the application is being loaded, checks if local Storage have token and userId and sets them in the
     * setUser mutation
     * @param {*} context
     * @returns
     */
    tryLogin(context) {
        const token = localStorage.getItem('token');
        const role = localStorage.getItem('role');
        console.log('Logged in using the tryLogin');

        if (token) {
            context.commit('setUser', {
                token,role
            });
        }
    },
    autoLogout(context) {
        context.dispatch('logout');
        context.commit('setAutoLogout');
    }
};
