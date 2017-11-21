import axios from 'axios';
import moxios from 'moxios';
import { mount } from 'vue-test-utils';
import Tasks from '../components/Tasks.vue';
import expect from 'expect';

describe('Tasks', () => {
	var wrapper;

	beforeEach(() => {
        moxios.install();

		wrapper = mount(Tasks);
	});

	afterEach(() => {
		moxios.uninstall();
	});

	it('hides the list if there are not tasks', () => {
		expect(wrapper.contains("ul")).toBe(false);
	});

	it('fetch the list of tasks from the server', (done) => {

		moxios.stubRequest('/tasks', {
			status: 200,
			response: [
				{ task: "Go to the store", completed: false},
				{ task: "Finish screencast", completed: false},
			]
		});

		moxios.wait(() => {
            expect(wrapper.find("ul").text()).toContain("Go to the store");

            done();
		});

	});

	it.only('can complete any task', (done) => {
		wrapper.setData({
			tasks: [
				{ id: 1, task: 'Go to the store', completed: false},
                { id: 2, task: 'Finish test', completed: false}
			],
		});

		moxios.stubRequest('/tasks/1/complete', {
			status: 200,
			response: {

			}
		});

        wrapper.find('ul > li:first-child .complete').trigger('click');

        moxios.wait(() => {
			expect(wrapper.find('ul').html()).not.toContain('Go to the store');

			done();
		});
	});
});
