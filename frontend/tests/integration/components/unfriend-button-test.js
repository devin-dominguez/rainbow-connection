import { moduleForComponent, test } from 'ember-qunit';
import hbs from 'htmlbars-inline-precompile';

moduleForComponent('unfriend-button', 'Integration | Component | unfriend button', {
  integration: true
});

test('it renders', function(assert) {
  // Set any properties with this.set('myProperty', 'value');
  // Handle any actions with this.on('myAction', function(val) { ... });

  this.render(hbs`{{unfriend-button}}`);

  assert.equal(this.$().text().trim(), '');

  // Template block usage:
  this.render(hbs`
    {{#unfriend-button}}
      template block text
    {{/unfriend-button}}
  `);

  assert.equal(this.$().text().trim(), 'template block text');
});
