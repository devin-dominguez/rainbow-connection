import Ember from 'ember';

export function rando(params) {
  let minNum = Math.floor(params[0]);
  let maxNum = Math.floor(params[1]);
  let range = maxNum - minNum;
  return Math.floor(Math.random() * range) + minNum;
}

export default Ember.Helper.helper(rando);
