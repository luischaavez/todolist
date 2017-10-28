import { mount } from 'vue-test-utils';
import NewTask from '../components/NewTask.vue';
import expect from 'expect';

describe('NewTask', () => {
	var wrapper;

	beforeEach(() => {
		wrapper = mount(NewTask);
	});

	it('allows users to create a new task', () => {
		var textArea = wrapper.find(".task");

		textArea.element.value = "Go to the store";
		textArea.trigger("input");

		wrapper.find("button").trigger("click");

		expect(wrapper.find("ul").text()).toContain("Go to the store");
	});
});
