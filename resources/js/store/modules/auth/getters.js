export default {
    userId(state) {
        return state.userId;
    },
    token(state) {
        return state.token;
    },
    isAuthenticated(state) {
        // We start without a token, and once we signup or login we set a token
        // in the state
        console.log('inside isAuthenticated');
        return !!state.token; // return boolean true if have a token
    },
    didAutoLogout(state) {
        return state.didAutoLogout;
    },
    isAdmin(state){
      return  state.role === 'admin';
    }
};
