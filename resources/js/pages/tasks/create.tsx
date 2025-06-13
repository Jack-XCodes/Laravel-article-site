import AppLayout from '@/layouts/app-layout';
import { TaskForm, type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/react';
import { LoaderCircle } from 'lucide-react';
import { FormEventHandler } from 'react';

import InputError from '@/components/input-error';
import TextLink from '@/components/text-link';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Create Task',
        href: '/tasks/create',
    },
];

export default function CreateTask() {
   const { data, setData, post, processing, errors } = useForm<Required<TaskForm>>({
          title: '',
          completed: false,
      });

      const submit: FormEventHandler = (e) => {
          e.preventDefault();
          post(route('tasks.store'));
      };
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Create Task" />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <div className="max-w-md mx-auto container p-4">
                <form className="flex flex-col gap-6" onSubmit={submit}>
                <div className="grid gap-6">
                    <div className="grid gap-2">
                        <Label htmlFor="title">Title</Label>
                        <Input
                            id="title"
                            type="text"
                            required
                            autoFocus
                            tabIndex={1}
                            autoComplete="email"
                            value={data.title}
                            onChange={(e) => setData('title', e.target.value)}
                            placeholder="First task"
                        />
                        <InputError message={errors.title} />
                    </div>

                    <div className="flex items-center space-x-3">
                        <Checkbox
                            id="completed"
                            name="completed"
                            checked={data.completed}
                            onClick={() => setData('completed', !data.completed)}
                            tabIndex={2}
                        />
                        <Label htmlFor="completed">Completed</Label>
                    </div>

                    <Button type="submit" className="mt-4 w-full" tabIndex={4} disabled={processing}>
                        {processing && <LoaderCircle className="h-4 w-4 animate-spin" />}
                        Create Task
                    </Button>
                </div>
            </form>
                </div>
            </div>
        </AppLayout>
    );
}
