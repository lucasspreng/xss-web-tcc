"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;

var _sequelize = require("sequelize");

var sequelize = new _sequelize.Sequelize("mysql://root:password@localhost:3306/projeto-vulneravel-node");
var _default = sequelize;
exports["default"] = _default;