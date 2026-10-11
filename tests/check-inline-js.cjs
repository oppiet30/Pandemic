const { spawnSync } = require('node:child_process');
const { Script } = require('node:vm');
const path = require('node:path');

const result = spawnSync('php', [path.join(__dirname, 'i18n.php'), '--scripts-json'], { encoding: 'utf8' });
if (result.status !== 0) {
  process.stderr.write(result.stderr || result.stdout || 'PHP rendering failed\n');
  process.exit(1);
}
const { assertions, scripts } = JSON.parse(result.stdout);
for (const [name, source] of Object.entries(scripts)) {
  new Script(source, { filename: name });
}
console.log(`${assertions} translation assertions and ${Object.keys(scripts).length} rendered JavaScript blocks passed.`);
