import { mount } from 'vue-test-utils';
import Tasks from '../components/Tasks.vue';
import expect from 'expect';

describe('Tasks', () => {
	var wrapper;

	beforeEach(() => {
		wrapper = mount(Tasks);
	});

	it('hides the list if there are not tasks', () => {
		expect(wrapper.contains("ul")).toBe(false);
	});

	it('allows to add a new task', () => {
		var input = wrapper.find(".task");

		input.element.value = "Go to the store";
		input.trigger("input");

		wrapper.find("button.add-task").trigger("click");

		expect(wrapper.find("ul").text()).toContain("Go to the store");
	});
});
