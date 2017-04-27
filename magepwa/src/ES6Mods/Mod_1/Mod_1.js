
/**
 * Created by Chris Dorward on 21/04/2017
 * src/ES6Mods/Mod_1
 * Main Application Entry Point. Small as possible
 */

class Mod_1 {

  comeInCharlie(incoming) {
    let message = '> response > type > ';
    message += 'vs' + globalData.version;
    const response = {
      incoming: incoming,
      status: 'ok',
      message: message
    };
    // console.log('ES6Mod_1\'s comeInCharlie() is working correctlt');
    return response;
  }

  renderContent(theContent) {
    let content = document.getElementById("content");
    content.innerHTML = 'Here is the Mod_1 content';
  }

  getVersion(incoming) {
    return 'vs' + globalData.version;;
  }

}

module.exports = Mod_1;
