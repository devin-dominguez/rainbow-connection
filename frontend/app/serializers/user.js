import DS from 'ember-data';

export default DS.RESTSerializer.extend({
  attrs: {
    firstName: 'first_name',
    lastName: 'last_name'
  },
  serializeAttribute(snapshot, json, key, attribute) {
    if (attribute.name === "friends") {
      return;
    }
    this._super(...arguments);
  }
});
