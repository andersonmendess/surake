import getFileUrl from "../utils/TelegramFiles.js";
const cmd = "/dd";

const act = async (ctx) => {

    const { message } = ctx;

    const reply = message.reply_to_message;

    if(!reply) {
        ctx.reply("Where's the content?")
    }

    const document = ctx.message.reply_to_message.document;

    const url = await getFileUrl(document.file_id);

    const size = document.file_size / 1000000;

    if(document.mime_type !== 'text/plain') {
        return ctx.reply("Invalid text file?")
    }

    if(size > 10) {
        return ctx.reply("too big file");
    }


    return ctx.reply(url)
}

export default { cmd, act };