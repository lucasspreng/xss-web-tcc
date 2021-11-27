"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.showPosts = exports.createPost = void 0;

var _sequelize = require("sequelize");

var _post = _interopRequireDefault(require("../models/post"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

var showPosts = function showPosts(req, res, next) {
  var filter = req.query.filter;
  var where = {};

  if (filter) {
    where = {
      title: _defineProperty({}, _sequelize.Op.like, "%".concat(filter, "%"))
    };
  }

  _post["default"].findAll({
    where: where
  }).then(function (posts) {
    res.render("index", {
      title: "Express",
      posts: posts,
      filter: filter
    });
  });
};

exports.showPosts = showPosts;

var createPost = function createPost(req, res, next) {
  var _req$body = req.body,
      title = _req$body.title,
      content = _req$body.content;

  _post["default"].create({
    title: title,
    content: content
  }).then(function () {
    res.redirect("/");
  });
};

exports.createPost = createPost;