import Telegraf from "telegraf";
import dotenv from 'dotenv';
dotenv.config();

import JustText from "./modules/JustText.js";
import DelDog from "./modules/DelDog.js";

const bot = new Telegraf(process.env.BOT_TOKEN)

bot.start((ctx) => ctx.reply('Welcome'))
bot.help((ctx) => ctx.reply('Send me a sticker'))
bot.on('sticker', (ctx) => {
    ctx.reply('👍')
    //ctx.message.reply_to_message.document.
})
bot.command(JustText.cmd, JustText.act)
bot.command(DelDog.cmd, DelDog.act)



bot.launch()