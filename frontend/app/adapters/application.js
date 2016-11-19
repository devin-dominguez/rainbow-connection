import DS from 'ember-data';

export default DS.RESTAdapter.extend({
  namespace: 'api',
  host: 'http://localhost:8000',

  unfriend(userId, friendId, callback) {
    let url = this.buildURL('user', userId);
    return this.ajax(`${url}/unfriend`, 'POST', {data: {friend_id : friendId}}).then(callback);
  }
});
