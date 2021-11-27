import { Op } from "sequelize";
import Post from "../models/post";

export const showPosts = (req, res, next) => {
  const { filter } = req.query;
  let where = {};
  if (filter) {
    where = {
      title: {
        [Op.like]: `%${filter}%`,
      },
    };
  }
  Post.findAll({ where }).then((posts) => {
    res.render("index", {
      title: "Express",
      posts,
      filter,
    });
  });
};

export const createPost = (req, res, next) => {
  const { title, content } = req.body;
  Post.create({
    title,
    content,
  }).then(() => {
    res.redirect("/");
  });
};
