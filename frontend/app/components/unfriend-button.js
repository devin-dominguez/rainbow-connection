import Ember from 'ember';

export default Ember.Component.extend({
  classNames: ['unfriend'],
  actions: {
    unfriend(user, friendId) {
      user.unfriend(friendId);
    }
  }
});
