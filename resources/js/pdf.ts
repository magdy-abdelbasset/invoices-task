import puppeteer from "puppeteer";

import * as fs from "fs" ;

async function genratePdf () {

  // Get type of source from process.argv, default to url
  var type = process.argv.slice(2)[0] || 'url';

  // Create a browser instance
  const browser = await puppeteer.launch();

  // Create a new page
  const page = await browser.newPage();


  if (type === 'url') {

    // Web site URL to export as pdf
    const website_url = 'http://women-care.localhost/api/user/health/get-pdf';

    // Open URL in current page
    await page.goto(website_url, { waitUntil: 'networkidle0' });

  } else if (type === 'file') {

    //Get HTML content from HTML file
    const html = fs.readFileSync('sample.html', 'utf-8');
    await page.setContent(html, { waitUntil: 'domcontentloaded' });

  } else {

    console.log(new Error(`HTML source "${type}" is unkown.`));
    await browser.close();
    return;
  }

  // To reflect CSS used for screens instead of print
  await page.emulateMediaType('screen');

  const pdf = await page.pdf({
    path: 'result.pdf',
    margin: { top: '0px', right: '30px', bottom: '0px', left: '30px' },
    printBackground: true,
    format: 'A4',
  });

  // Close the browser instance
  await browser.close();
  
};
export default genratePdf;