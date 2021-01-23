const cmd = "/jt";

const act = async (ctx) => {

    const { message } = ctx;

    const text = message.text.replace(cmd, "");
    const id = message.message_id;
    const reply = message.reply_to_message;
    
    ctx.deleteMessage(id)

    if(!reply) {
        return ctx.reply(text);
    }

    return ctx.reply(text, { reply_to_message_id : reply.message_id })
}

export default { cmd, act };