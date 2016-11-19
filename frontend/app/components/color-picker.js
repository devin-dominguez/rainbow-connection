import Ember from 'ember';

export default Ember.Component.extend({
  classNames: ['color-picker'],

  open: false,
  actions: {
    pickColor(color, user) {
      user.set('color', color);
      user.save();
      this.set('open', false);
    },

    toggleMenu() {
      if(this.open) {
        this.set('open', false);
      } else {
        this.set('open', true);
      }
    }
  }
});
