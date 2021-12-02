import axios from 'axios'

export default {
    /*****************************
    * P E R S O N A L  G R A N T *
    *****************************/

    /**
     * This route returns all of the scopes defined for your application. 
     * You may use this route to list the scopes a user may assign to a personal access token
     * 
     * @return Promise
     *
     * @docs https://laravel.com/docs/7.x/passport#managing-personal-access-tokens
     */
    getScopes() {
        return axios.get('/oauth/scopes')
    },

    /**
     * This route returns all of the personal access tokens that the authenticated user has created. 
     * This is primarily useful for listing all of the user's tokens so that they may edit or revoke them
     *
     * @return Promise
     *
     * @docs https://laravel.com/docs/7.x/passport#managing-personal-access-tokens
     */
    getPersonalAccessTokens() {
        return axios.get('/oauth/personal-access-tokens')
    },

    /**
     * This route creates new personal access tokens. It requires two pieces of data: 
     * the token's name and the scopes that should be assigned to the token
     *
     * @return Promise
     *
     * @docs https://laravel.com/docs/7.x/passport#managing-personal-access-tokens
     */
    createNewPersonalAccessToken(name, scopes) {
        let postData = {
            name: name,
            scopes: scopes 
        }

        return axios.post('/oauth/personal-access-tokens', postData)
    },

    /**
     * This route may be used to revoke personal access tokens:
     *
     * @return Promise
     *
     * @docs https://laravel.com/docs/7.x/passport#managing-personal-access-tokens
     */
    deletePersonalAccessToken(id) {
        return axios.delete('/oauth/personal-access-tokens/' + id)
    },

    revokeToken(id) {
        return axios.delete(`/user-token/revoke-token/${id}`)
    },

    /*****************************
    * P E R S O N A L  G R A N T *
    *****************************/

    /*****************************
    *  R E F R E S H  T O K E N  *
    *****************************/

    /**
     * Refresh token
     *
     * @postData - post information
     *
     * @return Promise
     */
    refreshToken(postData) {
        return axios.post('/oauth/token', {
            grant_type: 'refresh_token',
            refresh_token: postData.refresh_token,
            client_id: postData.client_id,
            client_secret: postData.client_secret,
            scope: ''
        });
    }, 
  

    /*****************************
    *  R E F R E S H  T O K E N  *
    *****************************/

    /*****************************
    * P A S S W O R D  G R A N T *
    *****************************/

    /**
     * This route returns all of the password tokens that the authenticated user has created. 
     * This is primarily useful for listing all of the user's tokens so that they may edit or revoke them
     *
     * @return Promise
     *
     * @docs https://laravel.com/docs/7.x/passport#managing-personal-access-tokens
     */
    getPasswordTokens() {
        return axios.get('/user-token/get-password-tokens')
    },

     /**
     * This route returns all of the personal access that the authenticated user has created. 
     * This is primarily useful for listing all of the user's tokens so that they may edit or revoke them
     *
     * @return Promise
     *
     * @docs https://laravel.com/docs/7.x/passport#managing-personal-access-tokens
     */
    getPersonalTokens() {
        return axios.get('/user-token/get-personal-tokens')
    },

    /**
     * Generate a token based on the user's credentials
     *
     * @postData - post information
     *
     * @return Promise
     */
    requestPasswordToken(postData) {
        return axios.post('/oauth/token', {
            grant_type: 'password',
            client_id: postData.client_id,
            client_secret: postData.client_secret,
            username: postData.username,
            password: postData.password,
            scope: ''
        });
    }, 

    /**
     * This route may be used to revoke authorized access tokens and their related refresh tokens:
     *
     * @param id <string> - the token id
     *
     * @return Promise
     */
    deleteUserToken(id) {
        return axios.delete('/oauth/tokens/' + id);
    },

    /*****************************
    * P A S S W O R D  G R A N T *
    *****************************/

    /**
     * This route returns all of the clients for the authenticated user. This is primarily useful for 
     * listing all of the user's clients so that they may edit or delete them.
     *
     * @return Promise
     */
    getUserClients() {
        return axios.get('/oauth/clients')
    },

    /**
     * This route is used to create new clients. It requires two pieces of data: the client's name and a redirect URL. 
     * The redirect URL is where the user will be redirected after approving or denying a request for authorization.
     * When a client is created, it will be issued a client ID and client secret. These values will be used when 
     * requesting access tokens from your application. The client creation route will return the new client instance
     * 
     * @param name <string> - the client name
     * @param redirect <string>  - the redirect url
     *
     * @return <Promise>
     */
    createNewClient(name, redirect) {
        let postData = {
            name,
            redirect
        }

        return axios.post('/oauth/clients', postData)
    },

    /**
     * This route is used to update clients. It requires two pieces of data: the client's name and a redirect URL. 
     * The redirect URL is where the user will be redirected after approving or denying a request for authorization. 
     * The route will return the updated client instance:
     * 
     * @param id <int> - the client ID
     * @param name <string> - the client name
     * @param redirect <string> - the redirect url

     */
    updateClient(id, name, redirect) {
        let postData = {
            name,
            redirect
        }

        return axios.put('/oauth/clients/' + id, data)
    },

    /** 
     * This route is used to delete clients:
     * 
     * @param id <string> - the client id
     *
     * @return <Promise>
     */
    deleteClient(id) {
        return axios.delete('/oauth/clients/' + id)
    }
}