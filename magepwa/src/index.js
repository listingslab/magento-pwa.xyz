
/**
 * Created by Chris Dorward on 21/04/2017
 * src/index
 * Main Application Entry Point. Small as possible

 // Writen in ES6, transpiled by Babel as a webpack module

 */

console.log('Magneto PWA');

import Mod_1 from './ES6Mods/Mod_1/Mod_1';
const Mod_1_Inst = new Mod_1();

Mod_1_Inst.comeInCharlie('bob IS yer uncle');
Mod_1_Inst.renderContent();

console.log(Mod_1_Inst.getVersion());
