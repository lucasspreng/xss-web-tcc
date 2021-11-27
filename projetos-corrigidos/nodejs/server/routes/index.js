import express from "express";
import { createPost, showPosts } from "../controllers/posts";

const router = express.Router();

/* GET home page. */
router.get("/", showPosts);

router.post("/store", createPost);

export default router;
