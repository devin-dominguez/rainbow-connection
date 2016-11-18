import Ember from 'ember';

const COLORS = [
  "yellow",
  "amber",
  "orange",
  "vermillion",
  "red",
  "magenta",
  "purple",
  "violet",
  "blue",
  "teal",
  "green",
  "chartreuse"
];

export function colors(colorNum/*, hash*/) {
  return COLORS[colorNum];
}

export default Ember.Helper.helper(colors);
