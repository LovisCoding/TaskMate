export default function (event, tabName) {
  const tabs = document.getElementsByClassName('tab-link');
  for (let i = 0; i < tabs.length; i++) {
	tabs[i].classList.remove('active-tab');
	if (tabs[i].id === tabName) tabs[i].classList.add('active-tab');
  }
}