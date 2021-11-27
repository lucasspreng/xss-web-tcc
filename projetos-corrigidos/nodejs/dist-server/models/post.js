"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;

var _sequelize = require("sequelize");

var _db = _interopRequireDefault(require("../config/db"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }

var Post = _db["default"].define("post", {
  id: {
    type: _sequelize.Sequelize.INTEGER,
    autoIncrement: true,
    allowNull: false,
    primaryKey: true
  },
  title: {
    type: _sequelize.Sequelize.STRING,
    allowNull: false
  },
  content: {
    type: _sequelize.Sequelize.STRING
  }
});

var _default = Post;
exports["default"] = _default;