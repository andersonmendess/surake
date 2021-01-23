import fetch from "node-fetch";
import dotenv from "dotenv";

const baseURL = `https://api.telegram.org/bot${process.env.BOT_TOKEN}`;
const baseFileURL = `https://api.telegram.org/file/${process.env.BOT_TOKEN}/`;

const getFileUrl = async (id) => {
  const info = await (await fetch(`${baseURL}/getFile?file_id=${id}`)).json();

  if (info["ok"]) {
    return baseFileURL + info["result"]["file_path"];
  }

  return false;
};

export default getFileUrl;
