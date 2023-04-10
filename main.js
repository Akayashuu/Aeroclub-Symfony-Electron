'use strict';
const electron = require('electron');
const { exec } = require('child_process')
const app = electron.app;
const BrowserWindow = electron.BrowserWindow; 

var php = require("gulp-connect-php");
var path = require("path");
let mainWindow;
app.on('window-all-closed', function () {
    if (process.platform != 'darwin') {
        app.quit();
        php.closeServer();
    }
});




app.on('ready', async function() {
  // fonction pour exécuter la commande de vérification de la version de VC++
  async function checkVC(version, arch) {
    return new Promise((resolve, reject) => {
      exec(`reg query HKEY_LOCAL_MACHINE\\SOFTWARE\\Microsoft\\VisualStudio\\14.0\\VC\\Runtimes\\X64`, (err, stdout, stderr) => {
        if (err) {
          // si la clé de registre n'existe pas, alors VC++ n'est pas installé
          resolve(false);
        } else {
          // sinon VC++ est installé
          resolve(true);
        }
      });
    });
  }

  // fonction pour exécuter la commande d'installation de VC++
  async function installVC(version, arch) {
    const vcPath = path.resolve(__dirname, 'redist', `VC_redist.${arch}.exe`);
    exec(`"${vcPath}" /norestart`, (err, stdout, stderr) => {
      if (err) {
        console.error(`Erreur lors de l'installation de VC++ ${version} (${arch}): ${err}`);
      } else {
        console.log(`VC++ ${version} (${arch}) a été installé avec succès.`);
      }
    });
  }

  // vérifier si VC++ 2015-2019 x64 est installé
  await checkVC('14.0', 'x64').then(async installed => {
    if (!installed) {
      // si VC++ n'est pas installé, alors l'installer
      await installVC('2015-2019 x64', 'x64');
    }
  });

  // vérifier si VC++ 2015-2019 x86 est installé
  await checkVC('14.0', 'x86').then(async installed => {
    if (!installed) {
      // si VC++ n'est pas installé, alors l'installer
      await installVC('2015-2019 x86', 'x86');
      app.quit();
    }
  });
    
  php.server({
    port:8000,
    base:path.resolve(__dirname) + "/src/public",
    bin:path.resolve(__dirname) + "/php8.2.0/php",
    stdio: "ignore",
    debug: false 
  });
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
