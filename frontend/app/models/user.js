import DS from 'ember-data';

export default DS.Model.extend({
  firstName: DS.attr('string'),
  lastName: DS.attr('string'),
  color: DS.attr('number'),
  friends: DS.attr(),

  unfriend(friendId, callback) {
    let modelName = this.constructor.modelName;
    let adapter = this.store.adapterFor(modelName);
    return adapter.unfriend(this.get('id'), friendId, (resp) => {
      this.reload();
    });
  }
});
