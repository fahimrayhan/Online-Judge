const io = require("socket.io")(3000);
const redis = require("socket.io-redis");
io.adapter(redis({ host: "db-redis-blr1-24907-do-user-9308348-0.b.db.ondigitalocean.com", port: 25061 }));
