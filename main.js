'use strict';
const electron = require('electron');
const app = electron.app;
const BrowserWindow = electron.BrowserWindow; 

var php = require("gulp-connect-php");
var path = require("path");
php.server({
    port:8000,
    base:path.resolve(__dirname) + "/src/public",
    bin:path.resolve(__dirname) + "/php8.2.0/php",
    stdio: "ignore",
    debug: false 
})


let mainWindow;
app.on('window-all-closed', function () {
    if (process.platform != 'darwin') {
        app.quit();
        php.closeServer();
    }
});




app.on('ready', function() {
    const { width, height } = electron.screen.getPrimaryDisplay().workAreaSize;
    mainWindow = new BrowserWindow({ width, height });
    mainWindow.maximize(); 
    mainWindow.setMenuBarVisibility(false);
    mainWindow.setTitle("Aeroclub - Pannel")
    mainWindow.loadURL("http://127.0.0.1:8000");
    mainWindow.on('closed', function () {
        mainWindow = null;
    });
});
